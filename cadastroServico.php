<?php 
		session_start();
		
		$permissao = $_SESSION["usuario"]["permissao"];
		if( $permissao == 'admin'){
			include "menu.php";
		}else{
			include "menufunc.php";
		}
    
    
      
	// iniciando variaveis 
	$id = $nome = $descricao = $valor = "";

	if ( $_GET ) {
		$id = trim( $_GET["id"] );

		$sql = "select * from servico where id = ? order by nome ";
		//"SELECT * FROM produto WHERE id = ? LIMIT 1";
		$consulta = $pdo->prepare($sql);
		$consulta->bindParam(1, $id);
		$consulta->execute();
		$dados = $consulta->fetch(PDO::FETCH_OBJ);

		//variavel recebe ->dados do objeto.
		$id = $dados->id;
		$nome = $dados->nome;
		$descricao = $dados->descricao;
		$valor = $dados->valor;

		$valor = number_format( $valor, 2, "," , ".");
		

	}
?>
<div id="wrapper">
	<div class="container-fluid">
		<div class="panel panel-edt">
		  		<div class="panel-heading panel-edt2">
		  		<h4 class="text-center panel-edt3">
			  		<i class="glyphicon glyphicon-plus-sign"></i> CADASTRO DE SERVIÇO</h4>
		  		</div>
		  	

			<div class="panel-body">
			   	<div>
					<a href="cadastroServico.php" class="btn btn-default pull-right">
					<i class="fa fa-refresh"></i> Resetar dados	
					</a>
					<br></br>
					<a href="listarServico.php" class="btn btn-default pull-right">
					<i class="glyphicon glyphicon-search"></i> Listar Serviços
					</a>
				</div>	
				<div class="clearfix"></div>

					<form name="form1" method="post" action="salvarServico.php" enctype="multipart/form-data" novalidate>
						<fieldset>
							<div class="col-md-1">
								<div class="control-group">
									<label for="id">ID</label>
										<div class="controls">
											<input type="text" readonly name="id" class="form-control" value="<?=$id;?>"></input>
		   		 						</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="control-group">
									<label for="nome">Nome do Serviço: </label>
									<div class="controls">
										<input type="text" name="nome" class="form-control" value="<?=$nome;?>" 
										required data-validation-required-message="Preencha o nome do Serviço"></input>
									</div>
								</div>
							</div>
							<div class="col-md-5">
								<div class="control-group">
									<label for="descricao">Descrição: </label>
									<div class="controls">
										<input type="text" name="descricao" class="form-control" value="<?=$descricao;?>"></input>
									</div>
								</div>
							</div>
							<div class="col-md-2">
								<div class="control-group">
									<label for="valor">Valor: </label>
									<div class="controls">
										<input type="text" name="valor" class="form-control valor" value="<?=$valor;?>" 
								required data-validation-required-message="Preencha o valor do serviço"></input>
									</div>
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



