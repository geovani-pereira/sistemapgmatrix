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
				  	<h4 class="text-center panel-edt3"><i class="glyphicon glyphicon-ok-sign"></i> Relatório Receita</h4>
				</div>
				<div class="panel-body">
					<a href="pdfReceita.php" title="Cadastro de Contas" target="_blank" class="btn btn-success pull-right">
						<i class="fa fa-file-pdf-o"></i> Gerar PDF
					</a>
					<br><br>
					<div class="clearfix"></div>

					<?php 
						//iniciar a variavel
						$palavra = "";
						if ( isset ( $_GET["palavra"] ) ) {
							$palavra = trim ( $_GET["palavra"] ); 
							//trim tira o espaço em branco
						}

						//$select vai ser usado na consulta ( $sql = "select...from...where ")
						$select = "";
						$valorTotal = "0";
						//$filtro pega do formulario o filtro recebendo se e todos produtos, fora de est e etc.
						$filtro = $_GET["filtro"];

						$complemento = "";
						if ( $filtro == "tc" ) {
								$dt1 = $_GET["dt1"];
								$dt2 = $_GET["dt2"];

								if ( ($dt2 == "") && ($dt1 != "") ) {
									
									$dt1 = DateTime::createFromFormat("d/m/Y",$dt1);
				                    $dt1 = $dt1->format("Y-m-d");

				                    $complemento = "and p.datapgto >= '$dt1'";

								}  else if ( ($dt1 == "") && ($dt2 != "") ) {
									//se a dt1 for vazia e a dt2 não -> faça
									$dt2 = DateTime::createFromFormat("d/m/Y",$dt2);
				                    $dt2 = $dt2->format("Y-m-d");

				                    $complemento = "and p.datapgto <= '$dt2'";
								} else if ( ($dt1 && $dt2) != "" ){
									//se a dt1 e dt2 nao for vazia -> faça
									$dt1 = DateTime::createFromFormat("d/m/Y",$dt1);
				                    $dt1 = $dt1->format("Y-m-d");
				                    $dt2 = DateTime::createFromFormat("d/m/Y",$dt2);
				                    $dt2 = $dt2->format("Y-m-d");

				                    $complemento = "and p.datapgto >= '$dt1' AND p.datapgto <= '$dt2'";
								} 
						}

						$select = "select p.id, p.id_ordem, o.descricao, p.valor, p.datapgto from parcela p inner join ordem o on ( o.id = p.id_ordem ) where p.datapgto != '' $complemento";
						

						$_SESSION['selectReceita'] = $select;
						$sql = "$select";

							$palavra = "%$palavra%";
							$consulta = $pdo->prepare( $sql );
							//passar um parametro
							$consulta->bindParam( 1, $palavra );
							$consulta->bindParam( 2, $dt1 );
                            $consulta->bindParam( 3, $dt2 );
							$consulta->execute();

						
						
					?>

					<div class="table-responsive">
						<table class="table table-bordered table-striped table-hover">
							<thead>
								<tr>
									<td width="1%">ID</td>
									<td>ID Ordem</td>
									<td>Descrição</td>
									<td>Valor</td>	
									<td>Data</td>	
								</tr>
							</thead>
							<?php
								while ( $dados = $consulta->fetch( PDO::FETCH_OBJ ) ) {

									$id = $dados->id;
									$id_ordem = $dados->id_ordem;
									$descricao = $dados->descricao;
									$valor = $dados->valor;
									$data = $dados->datapgto;
									
									$valor = number_format( $valor, 2, "," , ".");
									$data = date('d/m/Y', strtotime($data));


									echo "<tr>
												<td>$id</td>
												<td>$id_ordem</td>
												<td>$descricao</td>
												<td>R$ $valor</td>
												<td>$data</td>
											</tr>";

								}
							?>
						</table>
					</div>
				
					<?php 
						$sql = "select p.id, p.id_ordem, o.descricao,  sum(p.valor) valorTotal, p.datapgto from parcela p inner join ordem o on ( o.id = p.id_ordem ) where p.datapgto != '' $complemento";

							$palavra = "%$palavra%";
							$consulta = $pdo->prepare( $sql );
							//passar um parametro
							$consulta->bindParam( 1, $palavra );
							$consulta->bindParam( 2, $dt1 );
                            $consulta->bindParam( 3, $dt2 );
							$consulta->execute();
							

							while ( $dados = $consulta->fetch( PDO::FETCH_OBJ ) ) { 
							$valorTotal = $dados->valorTotal;
							$valorTotal = number_format( $valorTotal, 2, "," , ".");
							}
							echo "<h3>Valor Total: R$ $valorTotal</h3>";
					?>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		//funcao para perguntar se quer deletar


		$(document).ready( function(){
			//aplicar a dataTable na tabel
			$(".table").dataTable({
				"order": [[ 4, "desc" ]], 
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









