<?php 
	session_start();
		
		$permissao = $_SESSION["usuario"]["permissao"];
		if( $permissao == 'admin'){
			include "menu.php";
		}else{
			include "menufunc.php";
		}

$sql = "select COUNT(*) from cliente";


$consulta = $pdo->prepare( $sql );
$consulta->execute();
$qtdcliente = $consulta->fetchColumn();

$sql2 = "select p.*, c.nome from parcela p inner join ordem os on (p.id_ordem = os.id) inner join cliente c on (os.id_cliente = c.id) where datapgto is null group by nome";
$consulta2 = $pdo->prepare($sql2);
$consulta2->execute();

$qtddebito = $consulta2->rowCount();



?>

<div id="wrapper">
	<div class="container-fluid">
		<!-- ___________________________________abrir_Painel______________________________________________ -->
		<div class="well bg-white box-options">
			<div class="box-options-header">
				<h4 class="text-center panel-edt3">
					<i class="glyphicon glyphicon-user"></i>CLIENTES</h4>
				</div>
				<div class="box-options-body">

				<div class="panel-body panel-edt4">
					<div class="">
						<div class="row">
							<div class="col-lg-4 pad-top-15">
								<a class="acolor" href="cadastroCliente.php">
									<div class="caixa panel">
										<div class="acolor panel-heading">
											<div class="row">
												<div class="col-xs-6">
													<i class="fa fa-user-plus  fa-5x"></i>
												</div>
												<div class="col-xs-6 text-right">
													<p class="announcement-heading">+</p>
													<p class="announcement-text">Cadastrar novo cliente</p>
												</div>
											</div>
										</div>										
										<div class="panel-footer announcement-bottom">
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
								<a class="acolor" href="listarCliente.php">
								<div class="caixa panel">
									<div class="acolor panel-heading">
										<div class="row">
											<div class="col-xs-6">
												<i class="fa fa-users fa-5x"></i>
											</div>
											<div class="col-xs-6 text-right">
												<p class="announcement-heading"><?=$qtdcliente?></p>
												<p class="announcement-text">Clientes Cadastrados</p>
											</div>
										</div>
									</div>
									
										<div class="panel-footer announcement-bottom">
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
								<a class="acolor" href="listarClienteDebito.php">
								<div class="caixa panel">
									<div class="acolor panel-heading">
										<div class="row">
											<div class="col-xs-6">
												<i class="fa fa-money fa-5x"></i>
											</div>
											<div class="col-xs-6 text-right">
												<p class="announcement-heading"><?=$qtddebito?></p>
												<p class="announcement-text">Clientes com Débito</p>
											</div>
										</div>
									</div>
									
										<div class="panel-footer announcement-bottom">
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
		</div>
	</div>