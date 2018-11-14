<?php
	session_start();
		
		$permissao = $_SESSION["usuario"]["permissao"];
		if( $permissao == 'admin'){
			include "menu.php";
		}else{
			include "menufunc.php";
		}

	$data1 = "";
	$data2 = ""; 
?>
	<div id="wrapper">
		<div class="container-fluid">
			<div class="panel panel-edt">
				<div class="panel-heading panel-edt2">
				  	<h4 class="text-center panel-edt3"><i class="glyphicon glyphicon-ok-sign"></i> RELATÓRIO FINANCEIRA</h4>
				</div>
				<form action="relatorioFinanceiro.php?act=view" method="post">
				<div class="panel-body">
					<a href="financeiro.php" title="Cadastro de Financas" class="btn btn-success pull-right">
						<i class="glyphicon glyphicon-file"></i> Novo Cadastro
					</a>
					<br><br>
					<div class="clearfix"></div>
					<form action="relatorioFinanceiroo.php?act=view" method="post">
						<div class="col-md-4">
							<div class="control-group">
									<label for="data1" class="control-label">
									Data Inicial</label>
								<div class="input-group date">
									<input type="text" 
										name="data1" id="datetimepicker1"
										class="form-control"
										required 
										data-validation-required-message="Preencha a Inicial"
										value="<?=$data1;?>" >
										<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
								</div>
							</div>
						</div>
						<script>
	$('.input-group.date').datepicker({
	format: 'dd/mm/yyyy',
	language: 'pt-BR',
	weekStart: 0,
	autoclose: true
	});
</script>
<?php
	if (isset($_POST["data"])) {
		//recuperar a data digitada
		$data = $_POST["data"];
		//mostrar a data
		$data = $data->format("Y-m-d");
	}
?>

						<div class="panel-body">
						   	<div class="control-group">
								<label for="data2" class="control-label">Até a data:</label>
								<div class="input-group">
									<input type="date" 
									id="data2"
									name="data2"
									class="form-control"
									required
									data-validation-required-message="Preencha a data"
									value="<?=$data2;?>" >
									<span class="input-group-addon">
										<span class="glyphicon glyphicon-calendar"></span>
									</span>
								</div>
							</div>
							<br></br>
							<button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-eye-open"></i> Visualizar</button>
						</div>
			</form>
		</div>



		<?php 
			if(isset($_GET['act'])){
				if(isset($_POST['data1'])){
					$data1 = $_POST['data1'];
					$data2 = $_POST['data2'];

					// DESPESAS;;
					$sql = "select sum(valor) as despesa FROM financeiro where tipo = 'Despesa' and data >= ? AND data <= ?;";
					$consulta = $pdo->prepare( $sql );
					//passar um parametro
					$consulta->bindParam( 1, $data1 );
					$consulta->bindParam( 2, $data2 );
					//executa
					$consulta->execute();
					//separar os dados
					$dados = $consulta->fetch(PDO::FETCH_OBJ);
					$despesa = $dados->despesa;
					if($despesa == ''){
						$despesa = 0;
					}

					// RECEITA
					$sql = "select sum(valor) as receita FROM financeiro where tipo = 'Receita' and data >= ? AND data <= ?;";
					$consulta = $pdo->prepare( $sql );
					//passar um parametro
					$consulta->bindParam( 1, $data1 );
					$consulta->bindParam( 2, $data2 );
					//executa
					$consulta->execute();
					//separar os dados
					$dados = $consulta->fetch(PDO::FETCH_OBJ);
					$receita = $dados->receita;
					if($receita == ''){
						$receita = 0;
					}
					/*
					// COMPRAS DE PRODUTOS
					$sql = "select sum(valor) as receita FROM financeiro where tipo = 'Receita' and data >= ? AND data <= ?;";
					$consulta = $pdo->prepare( $sql );
					//passar um parametro
					$consulta->bindParam( 1, $data1 );
					$consulta->bindParam( 2, $data2 );
					//executa
					$consulta->execute();
					//separar os dados
					$dados = $consulta->fetch(PDO::FETCH_OBJ);
					$compras = $dados->compras;
					if($compras == ''){
						$compras = 0;
					}
					*/
					$lucroTotal = ($receita - $despesa);

					?>

					<script type="text/javascript" src="js/pieChart.js"></script>
						    <script type="text/javascript">
						      google.charts.load('current', {'packages':['corechart']});
						      google.charts.setOnLoadCallback(drawChart);

						      function drawChart() {

						        var data = google.visualization.arrayToDataTable([
						          ['Descrição', 'Valor'],
						          ['Lucro Total',     <?php echo "$lucroTotal";?>],
						          ['Despesas',      <?php echo "$despesa";?>],
						          ['Receita',  <?php echo "$receita";?>],
						        ]);

						        var options = {
						          title: 'Gráfico'
						        };

						        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

						        chart.draw(data, options);
						      }
					</script>
					<?php

					$lucroTotal = number_format( $lucroTotal, 2, "," ,"." );
					$receita = number_format( $receita, 2, "," ,"." );
					$despesa = number_format( $despesa, 2, "," ,"." );

					//converter a data
					$data1 = DateTime::createFromFormat("Y-m-d",$data1);
					$data1 = $data1->format("d/m/Y");
					$data2 = DateTime::createFromFormat("Y-m-d",$data2);
					$data2 = $data2->format("d/m/Y");

					echo "
							 <div class='well col-md-6'>
							 	<h2>Lucro Mensal</h2>
							 	<p>a partir da data $data1 até a data $data2</p>

								<div class='list-group'>
									<div class='list-group-item'  style='background-color: #3366CC'>
										<h4 style='color: #ffffff'>Lucro Total: $lucroTotal R$</h4>
									</div>
								</div>

								<div class='list-group'>
									<div class='list-group-item'  style='background-color: #FF9900'>
										<h4 style='color: #ffffff'>Receita: $receita R$</h4>
									</div>
								</div>

								<div class='list-group'>
									<div class='list-group-item'  style='background-color: #DC3912'>
										<h4 style='color: #ffffff'>Despesas: $despesa R$</h4>
									</div>
								</div>

							</div>

							<div class='table-responsive'>
								<div class='table'>
									<div>
								  		<div id='piechart' style='width: 590px; height: 390px;'></div>
								  	</div>
							  	</div>
							</div>";

				}else{
					return;
				}
				return;
			}
		?>

		<!-- ____________________________________________________________________________-->
		<?php
		if (isset($_POST["data1"])) {
		//recuperar a data digitada
		$data1 = $_POST["data1"];
		//mostrar a data

		$data1 = DateTime::createFromFormat("d/m/Y",$data1);
		$data1 = $data1->format("Y-m-d");
		}
		?>

		<?php
		if (isset($_POST["data2"])) {
		//recuperar a data digitada
		$data2 = $_POST["data2"];
		//mostrar a data

		$data2 = DateTime::createFromFormat("d/m/Y",$data2);
		$data2 = $data2->format("Y-m-d");
		}
		?>
				
		<!-- ____________________________________________________________________________-->

		
			<script type="text/javascript">
			            $(function () {
			                $('#datetimepicker1').datetimepicker();
			            });
			</script>
				</div>
			</div>
		</div>
	</div>
</body>
</html>









