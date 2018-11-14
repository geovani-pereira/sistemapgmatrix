<?php
	//incluir o menu
		session_start();
		
		$permissao = $_SESSION["usuario"]["permissao"];
		if( $permissao == 'admin'){
			include "menu.php";
		}else{
			include "menufunc.php";
		}

	$id = $marca = "";

	//verificar se está editando
	if ( isset ( $_GET["id"] ) ) {

		//recuperar o id por get
		$id = trim( $_GET["id"] );
		//selecionar os dados do banco
		$sql = "select * from marca where id = ? limit 1";
		//prepare
		$consulta = $pdo->prepare( $sql );
		//passar um parametro
		$consulta->bindParam( 1, $id );
		//executa
		$consulta->execute();
		//separar os dados
		$dados = $consulta->fetch(PDO::FETCH_OBJ);

		$id = $dados->id;
		$marca = $dados->marca;

	}


?>
	<div id="wrapper">
		<div class="container-fluid">
			<div class="panel menu-edt">
				<div class="panel-heading menu-edt2">
			  		<h4 class="text-center menu-edt3">
			  		<i class="glyphicon glyphicon-plus-sign"></i> CADASTRO DE MARCA</h4>
			  	</div>

				<div class="panel-body">

					<a href="produtoMarca.php" class="btn btn-success pull-right">
						<i class="glyphicon glyphicon-file"></i> Novo Cadastro
					</a>
					<br><br>
					<a href="listarMarca.php" class="btn btn-success pull-right">
						<i class="glyphicon glyphicon-search"></i> Listar Marcas
					</a>

					<div class="clearfix"></div>

					<form name="formcadastro" method="post" action="salvarMarca.php" novalidate>
						<fieldset>
							<div class="control-group">
								<label for="id">ID:</label>
								<div class="controls">
									<input type="text" name="id"
									class="form-control"
									readonly
									value="<?=$id;?>">
								</div>
							</div>

							<div class="control-group">
								<label for="marca">Marca:</label>
								<div class="controls">
									<input type="text" 
									name="marca"
									class="form-control"
									required
									data-validation-required-message="Preencha a marca"
									value="<?=$marca;?>">
								</div>
							</div>
							<br>
							<button type="submit" class="btn btn-success">Salvar Dados</button>
						</fieldset>
					</form>
				</div>
			</div>
		</div>
	</div>
</body>
</html>