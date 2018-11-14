<?php 
	session_start();
		
		$permissao = $_SESSION["usuario"]["permissao"];
		if( $permissao == 'admin'){
			include "menu.php";
		}else{
			include "menufunc.php";
		}
$permissao = ($_SESSION["usuario"]["permissao"]);


if ($permissao == "funcionario"){
	echo "<script>alert('Você não tem acesso a este nivel do sistema, entre em contato com o administrador');history.back();</script>";
}
?>

<div id="wrapper">
	<div class="container-fluid">
		<!-- ___________________________________abrir_Painel______________________________________________ -->
		<div class="panel panel-edt">
			<div class="panel-heading panel-edt2">
				<h4 class="text-center panel-edt3">
					<i class="fa fa-pie-chart fa-1x"></i> RELATÓRIO</h4>
			</div>

				<div class="panel-body panel-edt4">
					<div class="row">
						<!-- <DASH>-->
							<div class="col-lg-4">								
									<div class="panel caixa">
										<a class="acolor" href="relatorioProduto.php">
										<div class="panel-heading">
											<div class="row">
												<div class="col-xs-6">

													<i class="fa fa-archive fa-5x"></i>
												</div>
												<div class="col-xs-6 text-right">
													<p class="announcement-text">Produto</p>
												</div>
											</div>
										</div>
										<div class="panel-footer announcement-bottom bcolor">
											<div class="row">
												<div class="col-xs-6">Entrar</div>
												<div class="col-xs-6 text-right">
													<i class="fa fa-arrow-circle-right"></i>
												</div>
											</div>
										</div>
									</div>	
									</a>
								</div>

							<!-- </DASH>-->
							<!-- <DASH>-->
								<div class="col-lg-4">									
										<div class="panel caixa">
											<a class="acolor" href="relatorioServico.php">
											<div class="panel-heading">
												<div class="row">
													<div class="col-xs-6">							              	
														<i class="fa fa-handshake-o fa-5x"></i>
													</div>
													<div class="col-xs-6 text-right">
														<p class="announcement-text">Serviço</p>
													</div>
												</div>
											</div>
											<div class="panel-footer announcement-bottom bcolor">
												<div class="row">
													<div class="col-xs-6">Entrar</div>
													<div class="col-xs-6 text-right">
														<i class="fa fa-arrow-circle-right"></i>
													</div>
												</div>
											</div>
										</div>
										</a>
									</div>
								

								<!-- </DASH>-->
								<!-- <DASH>-->

									<div class="col-lg-4">										
											<div class="panel caixa">
												<a class="acolor" href="relatorioClientes.php">
												<div class="panel-heading">
													<div class="row">
														<div class="col-xs-6">							              	
															<i class="fa fa-id-card-o fa-5x"></i>
														</div>
														<div class="col-xs-6 text-right">
															<p class="announcement-text">Clientes</p>
														</div>
													</div>
												</div>
												<div class="panel-footer announcement-bottom bcolor">
													<div class="row">
														<div class="col-xs-6">Entrar</div>
														<div class="col-xs-6 text-right">
															<i class="fa fa-arrow-circle-right"></i>
														</div>
													</div>
												</div>
											</div>
											</a>
										</div>
					</div>
										<!-- </DASH>-->
									
								
									

									<div class="row">
										<!-- <DASH>-->
											<div class="col-lg-4">												
													<div class="panel caixa">
														<a class="acolor" href="relatorioOs.php">
														<div class="panel-heading">
															<div class="row">
																<div class="col-xs-6">							              	
																	<i class="fa fa fa-tags fa-5x"></i>
																</div>
																<div class="col-xs-6 text-right">
																	<p class="announcement-text">Ordem De Serviço</p>
																</div>
															</div>
														</div>
														<div class="panel-footer announcement-bottom bcolor">
															<div class="row">
																<div class="col-xs-6">Entrar</div>
																<div class="col-xs-6 text-right">
																	<i class="fa fa-arrow-circle-right"></i>
																</div>
															</div>
														</div>
													</div>
												</a>
											</div>

											<!-- </DASH>-->
											<!-- <DASH>-->
												<div class="col-lg-4">												
														<div class="panel caixa">
															<a class="acolor" href="relatorioFinanceiro.php">
															<div class="panel-heading">
																<div class="row">
																	<div class="col-xs-6">

																		<i class="fa fa-area-chart fa-5x"></i>
																	</div>
																	<div class="col-xs-6 text-right">
																		<p class="announcement-text">Finanças</p>
																	</div>
																</div>
															</div>
															<div class="panel-footer announcement-bottom bcolor">
																<div class="row">
																	<div class="col-xs-6">Entrar</div>
																	<div class="col-xs-6 text-right">
																		<i class="fa fa-arrow-circle-right"></i>
																	</div>
																</div>
															</div>
														</div>
													</a>
												</div><!-- </DASH>-->
									</div>	
				</div>													
		</div>
	</div>
</div>
							
