<?php 
			session_start();
		
		$permissao = $_SESSION["usuario"]["permissao"];
		if( $permissao == 'admin'){
			include "menu.php";
		}else{
			include "menufunc.php";
		}


$qtdestoque = $estoque = 0;
	//sql da quantidade de produtos cadastrado,
$sql = "select COUNT(*) from produto";
	//sql da quantidade de marcas cadastradas
$sql2 = "select COUNT(*) from marca";
	//sql para contar quantos produtos tem emestoque
$sql3 = "select * from produto";

$consulta3 = $pdo->prepare( $sql3 );
$consulta3->execute();

	//while para percorres os dados do banco
while ( $dados = $consulta3->fetch( PDO::FETCH_OBJ ) ) {

	$estoque = $dados->estoque;
			//salvando na variavel a quantidade de estoque do sql						
	$qtdestoque	= ($qtdestoque + $estoque);					

}

$consulta = $pdo->prepare( $sql );
$consulta2 = $pdo->prepare( $sql2 );

$consulta->execute();
$consulta2->execute();
	$consulta3->execute();		//fetchColumn conta as colunas da tabela
	$qtdprodutos = $consulta->fetchColumn();
	$qtdmarcas = $consulta2->fetchColumn();
	
	
	

	?>

	<div id="wrapper">
		<div class="container-fluid">
			<!-- ___________________________________abrir_Painel______________________________________________ -->


			<div class="well bg-white box-options">
				<div class="box-options-header">
					<h4 class="text-center panel-edt3">
						<i class="glyphicon glyphicon-user"></i>PRODUTOS</h4>
					</div>

					<div class="box-options-body">
						<div class="col-lg-4 pad-top-15">
							<a class="acolor" href="cadastroProduto.php">
							<div class="caixa panel">
								<div class="panel-heading">
									<div class="row">
										<div class="col-xs-6">
											
												<i class="fa fa-plus-circle fa-5x"></i>
											</div>
												<div class="col-xs-6 text-right">

													<p class="announcement-heading"><?=$qtdprodutos?></p>
													<p class="announcement-text">Cadastrar Produto</p>
												</div>
											</div>
											</div>
												<div class="panel-footer announcement-bottom bcolor">
													<div class="row">
														<div class="col-xs-6">
															Entrar
														</div>
														<div class="col-xs-6 text-right">
															<i class="fa fa-arrow-circle-right"></i>
														</div>
													</div>
												</div>
											</a>
										</div>
									</div>
									<div class="col-lg-4 pad-top-15">
										<a class="acolor" href="listarMarca.php">
										<div class="caixa panel">
											<div class="panel-heading">
												<div class="row">
													<div class="col-xs-6">
															<i class="fa fa-paperclip fa-5x"></i>
														</div>
															<div class="col-xs-6 text-right">
																<p class="announcement-heading"><?=$qtdmarcas?></p>
																<p class="announcement-text">Listar Marcas</p>
															</div>
														</div>
														</div>

															<div class="panel-footer announcement-bottom bcolor">
																<div class="row">
																	<div class="col-xs-6">
																		Entrar
																	</div>
																	<div class="col-xs-6 text-right">
																		<i class="fa fa-arrow-circle-right"></i>
																	</div>
																</div>
															</div>
														</a>
													</div>
												</div>
												<div class="col-lg-4 pad-top-15">
													<a class="acolor" href="listarProduto.php">
													<div class="caixa panel">
														<div class="panel-heading">
															<div class="row">
																<div class="col-xs-6">								
																	<i class="fa fa-list-alt fa-5x"></i>
																	</div>
																		<div class="col-xs-6 text-right">
																			<p class="announcement-heading">
																				<?=$qtdestoque?>
																			</p>
																			<p class="announcement-text">Produtos em Estoque</p>
																		</div>
																	</div>
																	</div>
																		<div class="panel-footer announcement-bottom bcolor">
																			<div class="row">
																				<div class="col-xs-6">
																					Entrar
																				</div>
																				<div class="col-xs-6 text-right">
																					<i class="fa fa-arrow-circle-right"></i>
																				</div>
																			</div>
																		</div>
																	</a>
																</div>
															</div>

														</div>
														<div class="clearfix"></div>
													</div>

												</div>
											</div>