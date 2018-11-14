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
            
            exit;
        }
	// iniciando variaveis 
	$id = $descricao = $valor = $data = $conta = "";

	if ( $_GET ) {
		$id = trim( $_GET["id"] );

		$sql = "select * from conta where id = ? order by descricao ";
		//"SELECT * FROM produto WHERE id = ? LIMIT 1";
		$consulta = $pdo->prepare($sql);
		$consulta->bindParam(1, $id);
		$consulta->execute();
		$dados = $consulta->fetch(PDO::FETCH_OBJ);

		//variavel recebe ->dados do objeto.
		$id = $dados->id;
		$descricao = $dados->descricao;
		$valor = $dados->valor;
		$data = $dados->data;
		$conta = $dados->conta;

		$valor = number_format( $valor, 2, "," , ".");
		$data = dataformatar($data);

	}
?>
<div id="wrapper">
	<div class="container-fluid">
		<div class="panel panel-edt">
		  		<div class="panel-heading panel-edt2">
		  		<h4 class="text-center panel-edt3">
			  		<i class="glyphicon glyphicon-usd"></i>DESPESA</h4>
		  		</div>
		  	

			<div class="panel-body">
			   	<div>
					<a href="conta.php" class="btn btn-default pull-right">
					<i class="fa fa-refresh"></i> Resetar dados	
					</a>
					<br></br>
					<a href="listarConta.php" class="btn btn-default pull-right">
					<i class="glyphicon glyphicon-search"></i> Lista de Despesas
					</a>
				</div>	
				<div class="clearfix"></div>

					<form name="form1" method="post" action="salvarConta.php" enctype="multipart/form-data" novalidate>
						<fieldset>
							<div class="col-md-1">
								<div class="control-group">
									<label for="id">ID</label>
										<div class="controls">
											<input type="text" readonly name="id" class="form-control" value="<?=$id;?>"></input>
		   		 						</div>
								</div>
							</div>
							<div class="col-md-5">
								<div class="control-group">
									<label for="descricao">Descrição: </label>
									<div class="controls">
										<input type="text" name="descricao" class="form-control" value="<?=$descricao;?>" 
										required data-validation-required-message="Preencha a descricao"></input>
									</div>
								</div>
							</div>
							<div class="col-md-1">
								<div class="control-group">
									<label for="valor">Valor: </label>
									<div class="controls">
										<input type="text" name="valor" class="form-control valor" value="<?=$valor;?>" 
								required data-validation-required-message="Preencha o valor"></input>
									</div>
								</div>
							</div>
							<div class="col-md-2">
								<div class="control-group">
									<label for="data" class="control-label">Data de Vencimento:</label>
									<div class="input-group date">
										<input type="text" name="data" id="datetimepicker1" class="form-control"
										required data-validation-required-message="Preencha a Data" value="<?=$data;?>" >
										<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
									</div>
								</div>
							</div>
					
							<script>
								$('.input-group.date').datepicker({
								format: 'dd/mm/yyyy',
								language: 'pt-BR',
								
								autoclose: true
								});
							</script>
							
							<?php
							/*
								if (isset($_POST["data"])) {
									//recuperar a data digitada
									$data = $_POST["data"];
									//mostrar a data
									$data = $data->format("Y-m-d");
								}
								*/
							?>
							<div class="col-md-2">
								<div class="control-group">
									<label for="conta">Status:</label>
									<div class="controls">
										<select	name="conta" id="conta" class="form-control" required
										data-validation-required-message="Selecione o Lançamento">
											<option value="Pago">Pago</option>
											<option value="Pendente">Pendente</option>
										</select>
									</div>
									<script type="text/javascript">
										$("#conta").val("<?=$conta;?>");
									</script>
								</div>
							</div>
							<br>
						</fieldset>
						<button type="submit" class="btn center-block btn-success btn-lg">Salvar Dados</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>



