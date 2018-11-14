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
				  	<h4 class="text-center panel-edt3"><i class="glyphicon glyphicon-ok-sign"></i> Relatorio Cliente</h4>
				</div>
				<div class="panel-body">
					<a href="pdfCliente.php" title="Cadastro de Contas" target="_blank" class="btn btn-success pull-right">
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
						
						//$tipo pega do formulario o tipo.
						$tipo = $_GET["tipo"];
							
						$complemento = "";
						if ( $tipo == "pendente" ) {
								$data1 = $_GET["data1"];
								$data2 = $_GET["data2"];
								$cpfcnpj = $_GET["cpfcnpj"];

								if ( $cpfcnpj == "" ) {
								$complementoCpf = "";
								} else {
								    $complementoCpf = "and c.cpfcnpj = '$cpfcnpj'";
								}

								if ( ($data2 == "") && ($data1 != "") ) {
									//se a data2 for vazia e a data1 não -> faça
									// se o data2 estiver vazia recebe a data atual
									
									$data1 = DateTime::createFromFormat("d/m/Y",$data1);
				                    $data1 = $data1->format("Y-m-d");

				                    $complemento = "and p.datavcto >= '$data1'";

								}  else if ( ($data1 == "") && ($data2 != "") ) {
									//se a data1 for vazia e a data2 não -> faça
									$data2 = DateTime::createFromFormat("d/m/Y",$data2);
				                    $data2 = $data2->format("Y-m-d");

				                    $complemento = "and p.datavcto <= '$data2'";
								} else if ( ($data1 && $data2) != "" ){
									//se a data1 e data2 nao for vazia -> faça
									$data1 = DateTime::createFromFormat("d/m/Y",$data1);
				                    $data1 = $data1->format("Y-m-d");
				                    $data2 = DateTime::createFromFormat("d/m/Y",$data2);
				                    $data2 = $data2->format("Y-m-d");

				                    $complemento = "and p.datavcto >= '$data1' AND p.datavcto <= '$data2'";
								} 
						} else if ( $tipo == "total" ) {
							$data1 = $_GET["data1"];
								$data2 = $_GET["data2"];
								$cpfcnpj = $_GET["cpfcnpj"];

								if ( $cpfcnpj == "" ) {
								$complementoCpf = "";
								} else {
								    $complementoCpf = "and c.cpfcnpj = '$cpfcnpj'";
								}

								if ( ($data2 == "") && ($data1 != "") ) {
									//se a data2 for vazia e a data1 não -> faça
									// se o data2 estiver vazia recebe a data atual
									
									$data1 = DateTime::createFromFormat("d/m/Y",$data1);
				                    $data1 = $data1->format("Y-m-d");

				                    $complemento = "and p.datavcto >= '$data1'";

								}  else if ( ($data1 == "") && ($data2 != "") ) {
									//se a data1 for vazia e a data2 não -> faça
									$data2 = DateTime::createFromFormat("d/m/Y",$data2);
				                    $data2 = $data2->format("Y-m-d");

				                    $complemento = "and p.datavcto <= '$data2'";
								} else if ( ($data1 && $data2) != "" ){
									//se a data1 e data2 nao for vazia -> faça
									$data1 = DateTime::createFromFormat("d/m/Y",$data1);
				                    $data1 = $data1->format("Y-m-d");
				                    $data2 = DateTime::createFromFormat("d/m/Y",$data2);
				                    $data2 = $data2->format("Y-m-d");

				                    $complemento = "and p.datavcto >= '$data1' AND p.datavcto <= '$data2'";
								} 
						} else {
							$cpfcnpj = $_GET["cpfcnpj"];

								if ( $cpfcnpj == "" ) {
								$complementoCpf = "";
								} else {
								    $complementoCpf = "and c.cpfcnpj = '$cpfcnpj'";
								}
						}


						//echo "$data1<br>$data2";

						if ($tipo == "clienteCompras") {
							$select = "select o.id_cliente id, c.nome, c.cpfcnpj, sum(p.valor) valor from parcela p inner join ordem o on ( o.id = p.id_ordem ) inner join cliente c on ( c.id = o.id_cliente ) where p.datapgto != '' $complementoCpf group by nome";
						} else if ($tipo == "total") {
							$select = "select p.id, c.nome, c.cpfcnpj, sum(p.valor) valor, p.datavcto from parcela p inner join ordem o on ( o.id = p.id_ordem ) inner join cliente c on ( c.id = o.id_cliente ) where datapgto is null $complemento $complementoCpf group by nome";
						} else if ($tipo == "pendente") {
							$select = "select p.id, c.nome, c.cpfcnpj, p.id_ordem, o.descricao, p.valor, p.datavcto from parcela p inner join ordem o on ( o.id = p.id_ordem ) 
								inner join cliente c on ( c.id = o.id_cliente ) where datapgto is null $complemento $complementoCpf";
						}

						$_SESSION['buscaCliente'] = $tipo;
						$_SESSION['selectCliente'] = $select;
						//fazer o sql
						$sql = "$select";

							$palavra = "%$palavra%";
							$consulta = $pdo->prepare( $sql );
							$consulta->bindParam( 1, $palavra );
							$consulta->bindParam( 2, $data1 );
                            $consulta->bindParam( 3, $data2 );
							$consulta->execute();
					?>
					<?php
						if ( $tipo == "clienteCompras" ) {
							echo "<div class'table-responsive'>
									<table class='table table-bordered table-striped table-hover'>
										<thead>
											<tr>
												<td>ID</td>
												<td>Nome</td>
												<td>CPF / CNPJ</td>
												<td>Gasto Total</td>									
											</tr>
											
										</thead> ";
										
												while ( $dados = $consulta->fetch( PDO::FETCH_OBJ ) ) {

													$id = $dados->id;
													$nome = $dados->nome;
													$cpfcnpj = $dados->cpfcnpj;
													$valor = $dados->valor;
													$valor = number_format( $valor, 2, "," ,"." );

													echo "<tr>
																<td>$id</td>
																<td>$nome</td>
																<td>$cpfcnpj</td>
																<td>R$ $valor</td>
															</tr>";
												}
							echo "</table>
							</div> ";
						} else if ( $tipo == "total" ) {
							echo "<div class'table-responsive'>
									<table class='table table-bordered table-striped table-hover'>
										<thead>
											<tr>
												<td>ID</td>
												<td>Nome</td>
												<td>CPF / CNPJ</td>
												<td>R$ Valor Total</td>
												<td>Vencimento</td>								
											</tr>
											
										</thead> ";
										
												while ( $dados = $consulta->fetch( PDO::FETCH_OBJ ) ) {

													$id = $dados->id;
													$nome = $dados->nome;
													$cpfcnpj = $dados->cpfcnpj;
													$valor = $dados->valor;
													$datavcto = $dados->datavcto;
													$valor = number_format( $valor, 2, "," ,"." );
													$datavcto = date('d/m/Y', strtotime($datavcto));
													echo "<tr>
																<td>$id</td>
																<td>$nome</td>
																<td>$cpfcnpj</td>
																<td>R$ $valor</td>
																<td>$datavcto</td>
															</tr>";
												}
							echo "</table>
							</div> ";
						} else if ( $tipo == "pendente" ) {
							echo "<div class'table-responsive'>
									<table class='table table-bordered table-striped table-hover'>
										<thead>
											<tr>
												<td>ID</td>
												<td>Nome</td>
												<td>CPF / CNPJ</td>
												<td>ID Ordem</td>
												<td>Descrição</td>
												<td>Valor</td>
												<td>Vencimento</td>									
											</tr>
											
										</thead> ";
										
												while ( $dados = $consulta->fetch( PDO::FETCH_OBJ ) ) {

													$id = $dados->id;
													$nome = $dados->nome;
													$cpfcnpj = $dados->cpfcnpj;
													$id_ordem = $dados->id_ordem;
													$descricao = $dados->descricao;
													$valor = $dados->valor;
													$datavcto = $dados->datavcto;
													$valor = number_format( $valor, 2, "," ,"." );
													$datavcto = date('d/m/Y', strtotime($datavcto));

													echo "<tr>
																<td>$id</td>
																<td>$nome</td>
																<td>$cpfcnpj</td>
																<td>$id_ordem</td>
																<td>$descricao</td>
																<td>R$ $valor</td>
																<td>$datavcto</td>
															</tr>";
												}
							echo "</table>
							</div> ";
						}
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