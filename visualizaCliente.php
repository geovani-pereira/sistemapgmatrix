<?php
	//incluir o menu
		session_start();
		
		$permissao = $_SESSION["usuario"]["permissao"];
		if( $permissao == 'admin'){
			include "menu.php";
		}else{
			include "menufunc.php";
		}

	$id = $data = $nome = $nascimento = $rg = $cpfcnpj = $telefone = $email = $rua = 
	$numero = $bairro = $cidade = $estado = $cep = "";


	//verificar se está editando
	if ( isset ( $_GET["id"] ) ) {

		//recuperar o id por get
		$id = trim( $_GET["id"] );
		//selecionar os dados do banco
		$sql = "select * from cliente where id = ? limit 1";
		//prepare
		$consulta = $pdo->prepare( $sql );
		//passar um parametro
		$consulta->bindParam( 1, $id );
		//executa
		$consulta->execute();
		//separar os dados
		$dados = $consulta->fetch(PDO::FETCH_OBJ);

		$id = $dados->id;
		$nome = $dados->nome;
		$data = $dados->nascimento;
		$rg = $dados->rg;
		$cpfcnpj = $dados->cpfcnpj;
		$telefone = $dados->telefone;
		$email = $dados->email;
		$rua = $dados->rua;
		$numero = $dados->numero;
		$bairro = $dados->bairro;
		$cidade = $dados->cidade;
		$estado = $dados->estado;
		$cep = $dados->cep;


	}


?>
	<div id="wrapper">
		<div class="container-fluid">
			<div class="panel menu-edt">
				<div class="panel-heading menu-edt2">
			  		<h4 class="text-center menu-edt3">
			  		<i class="glyphicon glyphicon-plus-sign"></i> CADASTRO DE CLIENTE</h4>
			  	</div>

				<div class="panel-body">

					<a href="cadastroCliente.php" class="btn btn-success pull-right">
						<i class="glyphicon glyphicon-file"></i> Novo Cadastro
					</a>
					<br><br>
					<a href="listarCliente.php" class="btn btn-success pull-right">
						<i class="glyphicon glyphicon-search"></i> Listar Clientes
					</a>

					<div class="clearfix"></div>

					<form name="formcadastro" method="post" action="salvarCliente.php" novalidate>
						<fieldset>
							<div class="col-md-2">
								<div class="control-group">
									<label for="id">ID:</label>
									<div class="controls">
										<input type="text" name="id"
										class="form-control"
										readonly
										value="<?=$id;?>">
									</div>
								</div>
							</div>

							<div class="col-md-5">
								<div class="control-group">
									<label for="nome">Nome Completo:</label>
									<div class="controls">
									<input type="text" name="nome" 
									class="form-control" readonly value="<?=$nome;?>">
									</div>
								</div>
							</div>

							<div class="col-md-5">
								<div class="control-group">
									<label for="data">
									Data de Nascimento:</label>
									<div class="controls">
										<input type="date" 
										name="data"
										class="form-control"
										readonly
										value="<?=$data;?>" >
									</div>
								</div>
							</div>
							<!-- ____________________________________________________________________________-->


						
							<?php

							if (isset($_POST["data"])) {
								//recuperar a data digitada
								$data = $_POST["data"];
								//mostrar a data

								$data = DateTime::createFromFormat("d/m/Y",$data);
								$data = $data->format("Y-m-d");
							}
							?>
							
							<!-- ____________________________________________________________________________-->

							<div class="col-md-3">
								<div class="control-group">
									<label for="rg">RG:</label>
									<div class="controls"><input type="text" name="rg" class="form-control" data-mask="99.999.999-9" readonly value="<?=$rg;?>">
									</div>
								</div>
							</div>

							<div class="col-md-3">
								<div class="control-group">
									<label for="cpfcnpj">CPF / CNPJ:</label>
									<div class="controls"><input type="text" name="cpfcnpj" class="form-control" data-mask="999.999.999-99" readonly value="<?=$cpfcnpj;?>">
									</div>
								</div>
							</div>

							<div class="col-md-3">
								<div class="control-group">
									<label for="telefone">Telefone:</label>
									<div class="controls"><input type="text" name="telefone" class="form-control" data-mask="(99)99999999" readonly value="<?=$telefone;?>">
									</div>
								</div>
							</div>

							<div class="col-md-3">
								<div class="control-group">
									<label for="email">E-mail:</label>
									<div class="controls"><input type="email" name="email" class="form-control" readonly value="<?=$email;?>">
									</div>
								</div>
							</div>

							<div class="col-md-4">
								<div class="control-group">
									<label for="rua">Rua:</label>
									<div class="controls"><input type="text" name="rua" class="form-control" readonly value="<?=$rua;?>">
									</div>
								</div>
							</div>

							<div class="col-md-2">
								<div class="control-group">
									<label for="numero">Numero:</label>
									<div class="controls"><input type="number" name="numero" 
										class="form-control" readonly value="<?=$numero;?>">
									</div>
								</div>
							</div>

							<div class="col-md-2">
								<div class="control-group">
									<label for="bairro">Bairro:</label>
									<div class="controls"><input type="text" name="bairro" 
										class="form-control" readonly value="<?=$bairro;?>">
									</div>
								</div>
							</div>

							<div class="col-md-4">
								<div class="control-group">
									<label for="cidade">Cidade:</label>
									<div class="controls"><input type="text" name="cidade" 
										class="form-control" readonly value="<?=$cidade;?>">
									</div>
								</div>
							</div>

							<div class="col-md-6">
								<div class="control-group">
									<label for="estado">Estado: </label>
									<div class="controls"><input type="text" name="estado" 
										class="form-control" readonly value="<?=$estado;?>">
									</div>
								</div>
							</div>

							<div class="col-md-6">
								<div class="control-group">
									<label for="cep">CEP:</label>
									<div class="controls"><input type="text" name="cep" class="form-control" readonly value="<?=$cep;?>">
									</div>
								</div>
							</div>
						</fieldset>
						<br>
					</form>
				</div>
			</div>
		</div>
	</div>
</body>
</html>