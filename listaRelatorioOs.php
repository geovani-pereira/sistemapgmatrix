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
				  	<h4 class="text-center panel-edt3"><i class="fa fa fa-tags fa-1x"></i> Relatório Ordem de Serviço</h4>
				</div>
				<div class="panel-body">
					<a href="pdfOs.php" title="Cadastro de Contas" target="_blank" class="btn btn-success pull-right">
						<i class="fa fa-file-pdf-o"></i> Gerar PDF
					</a>
					<br><br>
					<div class="clearfix"></div>

					<?php 
						//iniciar a variavel

						//$select vai ser usado na consulta ( $sql = "select...from...where ")
						$select = "";

						//$filtro pega do formulario o filtro recebendo se e todos produtos, fora de est e etc.
						$filtro = $_GET["filtro"];

						$complemento = "";
						if ( $filtro == "or" ) {
								$dt1 = $_GET["dt1"];
								$dt2 = $_GET["dt2"];


								if ( ($dt2 == "") && ($dt1 != "") ) {
									
									$dt1 = DateTime::createFromFormat("d/m/Y",$dt1);
				                    $dt1 = $dt1->format("Y-m-d");

				                    $complemento = "where os.datainicial >= '$dt1' and os.status = 'Orçamento' ";

								}  else if ( ($dt1 == "") && ($dt2 != "") ) {
									//se a dt1 for vazia e a dt2 não -> faça
									$dt2 = DateTime::createFromFormat("d/m/Y",$dt2);
				                    $dt2 = $dt2->format("Y-m-d");

				                    $complemento = "where os.datainicial <= '$dt2' and os.status = 'Orçamento'";
								} else if ( ($dt1 && $dt2) != "" ){
									//se a dt1 e dt2 nao for vazia -> faça
									$dt1 = DateTime::createFromFormat("d/m/Y",$dt1);
				                    $dt1 = $dt1->format("Y-m-d");
				                    $dt2 = DateTime::createFromFormat("d/m/Y",$dt2);
				                    $dt2 = $dt2->format("Y-m-d");

				                    $complemento = "where os.datainicial >= '$dt1' AND os.datainicial <= '$dt2' and os.status = 'Orçamento'";
								} else if ( ($dt1 && $dt2) == "" ) {
									$complemento = "where os.status = 'Orçamento'";
								}
						
						} else if ( $filtro == "an" ) {
							$dt1 = $_GET["dt1"];
								$dt2 = $_GET["dt2"];

								if ( ($dt2 == "") && ($dt1 != "") ) {
									
									$dt1 = DateTime::createFromFormat("d/m/Y",$dt1);
				                    $dt1 = $dt1->format("Y-m-d");

				                    $complemento = "where os.datainicial >= '$dt1' and os.status = 'Em Andamento'";

								}  else if ( ($dt1 == "") && ($dt2 != "") ) {
									//se a dt1 for vazia e a dt2 não -> faça
									$dt2 = DateTime::createFromFormat("d/m/Y",$dt2);
				                    $dt2 = $dt2->format("Y-m-d");

				                    $complemento = "where os.datainicial <= '$dt2' and os.status = 'Em Andamento'";
								} else if ( ($dt1 && $dt2) != "" ){
									//se a dt1 e dt2 nao for vazia -> faça
									$dt1 = DateTime::createFromFormat("d/m/Y",$dt1);
				                    $dt1 = $dt1->format("Y-m-d");
				                    $dt2 = DateTime::createFromFormat("d/m/Y",$dt2);
				                    $dt2 = $dt2->format("Y-m-d");

				                    $complemento = "where os.datainicial >= '$dt1' AND os.datainicial <= '$dt2' and os.status = 'Em Andamento'";
								} else if ( ($dt1 && $dt2) == "" ) {
									$complemento = "where os.status = 'Em Andamento'";
								}
						} else if ( $filtro == "ab" ) {
							$dt1 = $_GET["dt1"];
								$dt2 = $_GET["dt2"];

								if ( ($dt2 == "") && ($dt1 != "") ) {
									
									$dt1 = DateTime::createFromFormat("d/m/Y",$dt1);
				                    $dt1 = $dt1->format("Y-m-d");

				                    $complemento = "where os.datainicial >= '$dt1' and os.status = 'Aberto'";

								}  else if ( ($dt1 == "") && ($dt2 != "") ) {
									//se a dt1 for vazia e a dt2 não -> faça
									$dt2 = DateTime::createFromFormat("d/m/Y",$dt2);
				                    $dt2 = $dt2->format("Y-m-d");

				                    $complemento = "where os.datainicial <= '$dt2' and os.status = 'Aberto'";
								} else if ( ($dt1 && $dt2) != "" ){
									//se a dt1 e dt2 nao for vazia -> faça
									$dt1 = DateTime::createFromFormat("d/m/Y",$dt1);
				                    $dt1 = $dt1->format("Y-m-d");
				                    $dt2 = DateTime::createFromFormat("d/m/Y",$dt2);
				                    $dt2 = $dt2->format("Y-m-d");

				                    $complemento = "where os.datainicial >= '$dt1' AND os.datainicial <= '$dt2' and os.status = 'Aberto'";
								} else if ( ($dt1 && $dt2) == "" ) {
									$complemento = "where os.status = 'Aberto'";
								}
						} else if ( $filtro == "ca" ) {
							$dt1 = $_GET["dt1"];
								$dt2 = $_GET["dt2"];

								if ( ($dt2 == "") && ($dt1 != "") ) {
									
									$dt1 = DateTime::createFromFormat("d/m/Y",$dt1);
				                    $dt1 = $dt1->format("Y-m-d");

				                    $complemento = "where os.datainicial >= '$dt1' and os.status = 'Cancelado'";

								}  else if ( ($dt1 == "") && ($dt2 != "") ) {
									//se a dt1 for vazia e a dt2 não -> faça
									$dt2 = DateTime::createFromFormat("d/m/Y",$dt2);
				                    $dt2 = $dt2->format("Y-m-d");

				                    $complemento = "where os.datainicial <= '$dt2' and os.status = 'Cancelado'";
								} else if ( ($dt1 && $dt2) != "" ){
									//se a dt1 e dt2 nao for vazia -> faça
									$dt1 = DateTime::createFromFormat("d/m/Y",$dt1);
				                    $dt1 = $dt1->format("Y-m-d");
				                    $dt2 = DateTime::createFromFormat("d/m/Y",$dt2);
				                    $dt2 = $dt2->format("Y-m-d");

				                    $complemento = "where os.datainicial >= '$dt1' AND os.datainicial <= '$dt2' and os.status = 'Cancelado'";
								} else if ( ($dt1 && $dt2) == "" ) {
									$complemento = "where os.status = 'Cancelado'";
								}
						} else if ( $filtro == "fi" ) {
							$dt1 = $_GET["dt1"];
								$dt2 = $_GET["dt2"];

								if ( ($dt2 == "") && ($dt1 != "") ) {
									
									$dt1 = DateTime::createFromFormat("d/m/Y",$dt1);
				                    $dt1 = $dt1->format("Y-m-d");

				                    $complemento = "where os.datainicial >= '$dt1' and os.status = 'Finalizado'";

								}  else if ( ($dt1 == "") && ($dt2 != "") ) {
									//se a dt1 for vazia e a dt2 não -> faça
									$dt2 = DateTime::createFromFormat("d/m/Y",$dt2);
				                    $dt2 = $dt2->format("Y-m-d");

				                    $complemento = "where os.datainicial <= '$dt2' and os.status = 'Finalizado'";
								} else if ( ($dt1 && $dt2) != "" ){
									//se a dt1 e dt2 nao for vazia -> faça
									$dt1 = DateTime::createFromFormat("d/m/Y",$dt1);
				                    $dt1 = $dt1->format("Y-m-d");
				                    $dt2 = DateTime::createFromFormat("d/m/Y",$dt2);
				                    $dt2 = $dt2->format("Y-m-d");

				                    $complemento = "where os.datainicial >= '$dt1' AND os.datainicial <= '$dt2' and os.status = 'Finalizado'";
								} else if ( ($dt1 && $dt2) == "" ) {
									$complemento = "where os.status = 'Finalizado'";
								}
							}

						//echo "complemento $complemento";
						$select = "select os.id,os.datainicial,os.status, os.descricao, u.nome as usuario,c.nome from cliente c inner join ordem os on(os.id_cliente = c.id) inner join usuario 
							u on (os.id_usuario = u.id) left join parcela p on (os.id = p.id_ordem) $complemento group by id";
						
						$_SESSION['selectOs'] = $select;
						$sql = "$select";

							$consulta = $pdo->prepare( $sql );
							$consulta->execute();

					?>

					<div class="table-responsive">
						<table class="table table-bordered table-striped table-hover">
							<thead>
								<tr>
									<td width="1%">ID</td>
									<td>Data de Entrada</td>
									<td>Status</td>
									<td>Descrição</td>	
									<td>Usuario</td>
									<td>Cliente</td>	
								</tr>
							</thead>
							<?php
								while ( $dados = $consulta->fetch( PDO::FETCH_OBJ ) ) {

									$id = $dados->id;
									$datainicial = $dados->datainicial;
									$status = $dados->status;
									$descricao = $dados->descricao;
									$usuario = $dados->usuario;
									$nome = $dados->nome;
									
									
									$datainicial = date('d/m/Y', strtotime($datainicial));


									echo "<tr>
												<td>$id</td>
												<td>$datainicial</td>
												<td>$status</td>
												<td>$descricao</td>
												<td>$usuario</td>
												<td>$nome</td>
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