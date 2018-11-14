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
				  	<h4 class="text-center panel-edt3"><i class="glyphicon glyphicon-ok-sign"></i> Relatório Financeiro</h4>
				</div>
				<div class="panel-body">
					<a href="pdfDespesas.php" title="Cadastro de Contas" target="_blank" class="btn btn-success pull-right">
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
						$dt1 = "00/00/000";
                        $dt2 = "00/00/000";
						//$filtro pega do formulario o filtro recebendo se e todos produtos, fora de est e etc.
						$filtro = $_GET["filtro"];

						$complemento = "";
						if ( $filtro == "tc" ) {
								$dt1 = $_GET["dt1"];
								$dt2 = $_GET["dt2"];

								if ( ($dt2 == "") && ($dt1 != "") ) {
									
									$dt1 = DateTime::createFromFormat("d/m/Y",$dt1);
				                    $dt1 = $dt1->format("Y-m-d");

				                    $complemento = "where data >= '$dt1'";

								}  else if ( ($dt1 == "") && ($dt2 != "") ) {
									//se a dt1 for vazia e a dt2 não -> faça
									$dt2 = DateTime::createFromFormat("d/m/Y",$dt2);
				                    $dt2 = $dt2->format("Y-m-d");

				                    $complemento = "where data <= '$dt2'";
								} else if ( ($dt1 && $dt2) != "" ){
									//se a dt1 e dt2 nao for vazia -> faça
									$dt1 = DateTime::createFromFormat("d/m/Y",$dt1);
				                    $dt1 = $dt1->format("Y-m-d");
				                    $dt2 = DateTime::createFromFormat("d/m/Y",$dt2);
				                    $dt2 = $dt2->format("Y-m-d");

				                    $complemento = "where data >= '$dt1' AND data <= '$dt2'";
								} 
						} else if ( $filtro == "go" ) {
							$dt1 = $_GET["dt1"];
								$dt2 = $_GET["dt2"];

								if ( ($dt2 == "") && ($dt1 != "") ) {
									
									$dt1 = DateTime::createFromFormat("d/m/Y",$dt1);
				                    $dt1 = $dt1->format("Y-m-d");

				                    $complemento = "and data >= '$dt1'";

								}  else if ( ($dt1 == "") && ($dt2 != "") ) {
									//se a dt1 for vazia e a dt2 não -> faça
									$dt2 = DateTime::createFromFormat("d/m/Y",$dt2);
				                    $dt2 = $dt2->format("Y-m-d");

				                    $complemento = "and data <= '$dt2'";
								} else if ( ($dt1 && $dt2) != "" ){
									//se a dt1 e dt2 nao for vazia -> faça
									$dt1 = DateTime::createFromFormat("d/m/Y",$dt1);
				                    $dt1 = $dt1->format("Y-m-d");
				                    $dt2 = DateTime::createFromFormat("d/m/Y",$dt2);
				                    $dt2 = $dt2->format("Y-m-d");

				                    $complemento = "and data >= '$dt1' AND data <= '$dt2'";
								} 
						} else if ( $filtro == "pa" ) {
							$dt1 = $_GET["dt1"];
								$dt2 = $_GET["dt2"];

								if ( ($dt2 == "") && ($dt1 != "") ) {
									
									$dt1 = DateTime::createFromFormat("d/m/Y",$dt1);
				                    $dt1 = $dt1->format("Y-m-d");

				                    $complemento = "and data >= '$dt1'";

								}  else if ( ($dt1 == "") && ($dt2 != "") ) {
									//se a dt1 for vazia e a dt2 não -> faça
									$dt2 = DateTime::createFromFormat("d/m/Y",$dt2);
				                    $dt2 = $dt2->format("Y-m-d");

				                    $complemento = "and data <= '$dt2'";
								} else if ( ($dt1 && $dt2) != "" ){
									//se a dt1 e dt2 nao for vazia -> faça
									$dt1 = DateTime::createFromFormat("d/m/Y",$dt1);
				                    $dt1 = $dt1->format("Y-m-d");
				                    $dt2 = DateTime::createFromFormat("d/m/Y",$dt2);
				                    $dt2 = $dt2->format("Y-m-d");

				                    $complemento = "and data >= '$dt1' AND data <= '$dt2'";
								}
						}
                        

						/*verefica como veio do formulario filtro ( tp,em,fe ) para jogar na variavel $select para ser usada no $sql*/
						$dataAtual = date('Y-m-d');

						if ($filtro == "tc") {
							$select = "select * from conta $complemento";
						} else if ($filtro == "go") {
							$select = "select * from conta where conta = 'Pago' $complemento";
						} else if ($filtro == "pa") {
							$select = "select * from conta where conta = 'Pendente' $complemento";
						} else if ($filtro == "ve") {
							$select = "select * from conta where conta = 'Pendente' and data < '$dataAtual'";
						} else if ($filtro == "ul") {
							$select = "select * from conta where conta = 'Pendente' and data = '$dataAtual'";
						}

						//session sera utilizado no pdfDespesas.php para geral o pdf
						$_SESSION['selectDespesas'] = $select;
						//fazer o sql
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
									<td>Descrição</td>
									<td>Valor</td>	
									<td>Data</td>
									<td>Conta</td>		
								</tr>
							</thead>
							<?php
								while ( $dados = $consulta->fetch( PDO::FETCH_OBJ ) ) {

									$id = $dados->id;
									$descricao = $dados->descricao;
									$valor = $dados->valor;
									$data = $dados->data;
									$conta = $dados->conta;

									$valor = number_format( $valor, 2, "," , ".");
									$data = date('d/m/Y', strtotime($data));		

									echo "<tr>
												<td>$id</td>
												<td>$descricao</td>
												<td>R$ $valor</td>
												<td>$data</td>
												<td>$conta</td>
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









