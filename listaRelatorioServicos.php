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
				  	<h4 class="text-center panel-edt3"><i class="fa fa-handshake-o"></i> Relatório de Serviços</h4>
				</div>
				<div class="panel-body">
					<a href="pdfServicos.php" title="Cadastro de Contas" target="_blank" class="btn btn-success pull-right">
						<i class="fa fa-file-pdf-o"></i> Gerar PDF
					</a>
					<br><br>
					<br><br>
					<div class="clearfix"></div>

					<?php 

						//$select vai ser usado na consulta ( $sql = "select...from...where ")
						$select = "";
						$complemento = "";
						//$tipo pega do formulario o tipo.
						$tipo = $_GET["tipo"];

						if ($tipo == "tp") {
							$dt1 = $_GET["dt1"];
							$dt2 = $_GET["dt2"];

							if ( ($dt2 == "") && ($dt1 != "") ) {
									
								$dt1 = DateTime::createFromFormat("d/m/Y",$dt1);
				                $dt1 = $dt1->format("Y-m-d");

				                $complemento = "where o.datainicial >= '$dt1'";

							}  else if ( ($dt1 == "") && ($dt2 != "") ) {
								//se a dt1 for vazia e a dt2 não -> faça
								$dt2 = DateTime::createFromFormat("d/m/Y",$dt2);
				                $dt2 = $dt2->format("Y-m-d");

				                $complemento = "where o.datainicial <= '$dt2'";
							} else if ( ($dt1 && $dt2) != "" ){
								//se a dt1 e dt2 nao for vazia -> faça
								$dt1 = DateTime::createFromFormat("d/m/Y",$dt1);
				                $dt1 = $dt1->format("Y-m-d");
				                $dt2 = DateTime::createFromFormat("d/m/Y",$dt2);
				                $dt2 = $dt2->format("Y-m-d");

				                $complemento = "where o.datainicial >= '$dt1' AND o.datainicial <= '$dt2'";
							} 
						}
						$select = "SELECT count(s.nome) as qtd,sum(so.valor) as valort,so.id, s.nome, so.valor, o.datainicial from servico_os so inner join servico s on ( s.id = so.id_servico ) inner join ordem o on ( o.id = so.id_ordem ) $complemento group by s.nome";
						
						$_SESSION['selectServicos'] = $select;

						$sql = "$select";
						//fazer o sql
						$consulta = $pdo->prepare( $sql );
						$consulta->execute();
					?>
					<div class="table-responsive">
						<table class="table table-bordered table-striped table-hover">
							<thead>
								<tr>
									<td width="1%">ID</td>
									<td>Nome</td>
									<td>Valor</td>
									<td>Total</td>
									<td>QTD</td>
																
								</tr>
							</thead>
							<?php
								while ( $dados = $consulta->fetch( PDO::FETCH_OBJ ) ) {

									$id = $dados->id;
									$nome = $dados->nome;
									$valor = $dados->valor;
									$valort = $dados->valort;
									$qtd = $dados->qtd;

									$valor = number_format( $valor, 2, "," , ".");
									$valort = number_format( $valort, 2, "," , ".");
										

									echo "<tr>
												<td>$id</td>
												<td>$nome</td>
												<td>R$ $valor</td>
												<td>R$ $valort</td>
												<td>$qtd</td>
												
											</tr>";
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









