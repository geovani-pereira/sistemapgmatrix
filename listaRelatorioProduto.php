<?php
	session_start();
		
		$permissao = $_SESSION["usuario"]["permissao"];
		if( $permissao == 'admin'){
			include "menu.php";
		}else{
			include "menufunc.php";
		}
    
    
         if ($permissao == "funcionario"){
            echo "<script>alert('Você não tem acesso a este nivel do sistema, entre em contato com o administrador');history.back();</script>";
            
            
        }
?>
	<div id="wrapper">
		<div class="container-fluid">
			<div class="panel panel-edt">
				<div class="panel-heading panel-edt2">
				  	<h4 class="text-center panel-edt3"><i class="glyphicon glyphicon-ok-sign"></i> Relatorio Produto</h4>
				</div>
				<div class="panel-body">
					<a href="pdfProdutos.php" title="Cadastro de Contas" target="_blank" class="btn btn-success pull-right">
						<i class="fa fa-file-pdf-o"></i> Gerar PDF
					</a>
					<br><br>
					<div class="clearfix"></div>

					<?php 

						//$select vai ser usado na consulta ( $sql = "select...from...where ")
						$select = "";

						//buscar a marca para jogar no select
						$id_marca = $_GET["id_marca"];

						//$tipo pega do formulario o tipo recebendo se e todos produtos, fora de est e etc.
						$tipo = $_GET["tipo"];

						//para evitar um erro no sql deixa vazio o complemento
						if ( $tipo == "mv" ) {
							$dt1 = $_GET["dt1"];
							$dt2 = $_GET["dt2"];

							$complemento1 = "";

							if ( ($dt2 == "") && ($dt1 != "") ) {
									
								$dt1 = DateTime::createFromFormat("d/m/Y",$dt1);
				                $dt1 = $dt1->format("Y-m-d");

				                $complemento1 = "where o.datainicial >= '$dt1'";

							}  else if ( ($dt1 == "") && ($dt2 != "") ) {
								//se a dt1 for vazia e a dt2 não -> faça
								$dt2 = DateTime::createFromFormat("d/m/Y",$dt2);
			                    $dt2 = $dt2->format("Y-m-d");

			                    $complemento1 = "where o.datainicial <= '$dt2'";
							} else if ( ($dt1 && $dt2) != "" ){
								//se a dt1 e dt2 nao for vazia -> faça
								$dt1 = DateTime::createFromFormat("d/m/Y",$dt1);
			                    $dt1 = $dt1->format("Y-m-d");
			                    $dt2 = DateTime::createFromFormat("d/m/Y",$dt2);
			                    $dt2 = $dt2->format("Y-m-d");

			                    $complemento1 = "where o.datainicial >= '$dt1' AND o.datainicial <= '$dt2'";
							}
						}

						$complemento2 = "";
						if ( $id_marca == "" ) {
							$complemento2 = "";
						} else {
						    $complemento2 = "and marca = '$id_marca'";
						}

						
						/*verefica como veio do formulario tipo ( tp,em,fe ) para jogar na variavel $select para ser usada no $sql*/
						if ($tipo == "tp") {
							$select = "select p.*, m.marca from produto p inner join marca m on ( m.id = p.id_marca ) $complemento2";
						} else if ($tipo == "em") {
							$select = "select p.*, m.marca from produto p inner join marca m on ( m.id = p.id_marca ) where estoque = '1' $complemento2";
						} else if ($tipo == "fe") {
							$select = "select p.*, m.marca from produto p inner join marca m on ( m.id = p.id_marca ) where estoque = '0' $complemento2";
						} else if ($tipo == "mv") {
							$select = "select pos.id_produto id, p.nome, m.marca, sum(pos.valor) valorTotal, count(pos.id_ordem) vendidos, o.datainicial from produto_os pos inner join produto p on ( p.id = pos.id_produto ) inner join ordem o on ( o.id = pos.id_ordem ) inner join marca m on ( m.id = p.id_marca ) $complemento1 $complemento2 group by id_produto";
						}

						//sessoon que vai ser utilizada no pdf
						$_SESSION['selectProdutosTipo'] = $tipo;
						$_SESSION['selectProdutos'] = $select;
						//fazer o sql
						$sql = "$select";
						$consulta = $pdo->prepare( $sql );
						$consulta->bindParam( 1, $tipo );
						$consulta->execute();

					?>
					<div class="table-responsive">
						<table class="table table-bordered table-striped table-hover">
						<?php
							if ($tipo == "mv") {
								echo "<thead>
										<tr>
											<td>ID</td>
											<td>Nome do Produto</td>
											<td>Marca</td>
											<td>Vendidos</td>
											<td>Valor Total</td>
											<td>Data</td>					
										</tr>
									  </thead>";
								
									

										while ( $dados = $consulta->fetch( PDO::FETCH_OBJ ) ) {

											$id = $dados->id;
											$nome = $dados->nome;
											$marca = $dados->marca;
											$vendidos = $dados->vendidos;
											$valorTotal = $dados->valorTotal;
											$datainicial = $dados->datainicial;

											$datainicial = date('d/m/Y', strtotime($datainicial));
											$valorTotal = number_format( $valorTotal, 2, "," , ".");

											echo "<tr>
														<td>$id</td>
														<td>$nome</td>
														<td>$marca</td>
														<td>$vendidos</td>
														<td>R$ $valorTotal</td>
														<td>$datainicial</td>
													</tr>";
										}
								} else {
									echo "<thead>
										<tr>
											<td>ID</td>
											<td>Nome</td>
											<td>Marca</td>
											<td>Estoque</td>
											<td>Valor</td>				
										</tr>
									  </thead>";
								
									

										while ( $dados = $consulta->fetch( PDO::FETCH_OBJ ) ) {

											$id = $dados->id;
											$nome = $dados->nome;
											$marca = $dados->marca;
											$estoque = $dados->estoque;
											$valor = $dados->valor;

											$valor = number_format( $valor, 2, "," , ".");

											echo "<tr>
														<td>$id</td>
														<td>$nome</td>
														<td>$marca</td>
														<td>$estoque</td>
														<td>R$ $valor</td>
													</tr>";
										}
									}	
						?>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		//funcao para perguntar se quer deletar


		$(document).ready( function(){
			//aplicar a dataTable na tabel
			$(".table").dataTable({
				"order": [[ 3, "desc" ]], 
				"language": {
					"lengthMenu": "Mostrando _MENU_ registros por página",
					"zeroRecords": "Nenhum registro encontrado com os dados informados",
					"info": "Mostrando _PAGE_ de _PAGES_",
					"infoEmpty": "Nenhum dado",
					"infoFiltered": "(filtrado de _MAX_ total)",
					"search": "Busca: ",
					"paginate": {
						"previous": "Anterior",
						"next": "Próxima"
					}
				}
			});
		} ) 
	</script>
</body>
</html>