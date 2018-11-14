<?php
	session_start();
		
		$permissao = $_SESSION["usuario"]["permissao"];
		if( $permissao == 'admin'){
			include "menu.php";
		}else{
			include "menufunc.php";
		}

	$id = $nome = $cpfcnpj = $permissao = $ativo = $login = $email = $senha = $telefone = "";
       
      
    
    
         if ($permissao == "funcionario"){
            echo "<script>alert('Você não tem acesso a este nivel do sistema, entre em contato com o administrador');history.back();</script>";
            
            
        }

	//verificar se está editando
	if ( isset ( $_GET["id"] ) ) {

		//recuperar o id por get
		$id = trim( $_GET["id"] );
		//selecionar os dados do banco
		$sql = "select * from usuario where id = ? limit 1";
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
		$cpfcnpj = $dados->cpfcnpj;
		$permissao = $dados->permissao;
		$ativo = $dados->ativo;
		$login = $dados->login;
                $email = $dados->email;
		$senha = $dados->senha;
		$telefone = $dados->telefone;


	}
         
?>
	<div id="wrapper">
		<div class="container-fluid">
			<div class="panel panel-edt">
						<div class="panel-heading panel-edt2">
			  			<h4 class="text-center panel-edt3">
			  			<i class="glyphicon glyphicon-plus-sign"></i> CADASTRO DE USUÁRIOS</h4>
			  			</div>

				<div class="panel-body">
						<div>
							<a href="cadastroUsuario.php" class="btn btn-default pull-right">
							<i class="fa fa-refresh"></i> Resetar dados
							</a>
							<br><br>
							<a href="listarUsuario.php" class="btn btn-default pull-right">
							<i class="glyphicon glyphicon-search"></i> Listar Usuários
							</a>
						</div>	
							<div class="clearfix"></div>

						<form name="formcadastro" method="post" action="salvarUsuario.php" novalidate>
					<fieldset>
							<div class="col-md-1">
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

							<div class="col-md-6">
								<div class="control-group">
										<label for="nome">Nome Completo:</label>
									<div class="controls"><input type="text" name="nome" class="form-control" required 
										data-validation-required-message="Preencha o nome" maxlength="100" value="<?=$nome;?>">
									</div>
								</div>
							</div>

							<div class="col-md-5">
								<div class="control-group">
									<label for="cpfcnpj">CPF:</label>
										<div class="controls">
										<input type="text" name="cpfcnpj"
									onkeydown="javascript:return aplica_mascara_cpfcnpj(this,18,event)" onkeyup="javascript:return aplica_mascara_cpfcnpj(this,18,event)"
                                                                        class="form-control" required placeholder="Digite somente números" maxlength="14" value="<?=$cpfcnpj;?>">
									</div>
								</div>
							</div>	

							<div class="col-md-4">
								<div class="control-group">
									<label for="login">Login:</label>
									<div class="controls">
										<input type="text" name="login" class="form-control" required 
										data-validation-required-message="Preencha o login" maxlength="100" value="<?=$login;?>">
									</div>
								</div>
							</div>
                                            
                                                        <div class="col-md-4">
								<div class="control-group">
									<label for="email">Email:</label>
									<div class="controls">
										<input type="text" name="email" class="form-control" required 
										data-validation-required-message="Preencha o login" maxlength="100" value="<?=$email;?>">
									</div>
								</div>
							</div>

							<div class="col-md-4">
								<div class="control-group">
									<label for="telefone">Telefone:</label>
									<div class="controls"><input type="text" name="telefone" class="form-control" data-mask="(99)99999999?9" required data-validation-required-message="Preencha o CPF" maxlength="14" placeholder="Digite somente número" value="<?=$telefone;?>">
									</div>
								</div>
							</div>

							<div class="col-md-4">
								<div class="control-group">
									<label for="senha">Senha:</label>
									<div class="controls"><input type="password" name="senha" class="form-control" <?php if ( empty ( $senha ) ) echo "required data-validation-required-message='Preencha a senha'";?>
						
										>
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="control-group">
								<label for="senha">
								Re-digite a Senha:</label>
								<div class="controls">
									<input type="password" 
									class="form-control"
									data-validation-match-match="senha"
									data-validation-match-message="As senhas digitadas são diferentes"
									>
								</div>
							</div>
						</div>
							<div class="col-md-3">
							<div class="control-group">
								<br>
							<label for="permissao">	Permissão:</label>
							<div class="controls">
							<input type="radio" name="permissao"
							value="admin" checked id="admin" required		data-validation-required-message="Selecione uma opção"> Administrador
							<input type="radio"	name="permissao" checked id="funcionario"
							value="funcionario"	required data-validation-required-message="Selecione uma opção"> Funcionário
							</div>
							</div>
							</div>

							
							<div class="col-md-2">
							<div class="control-group">
								<br>
							<label for="ativo">Ativo:</label>
							<div class="controls">
								<input type="radio"	name="ativo" value="Sim" checked id="ativosim" required
							data-validation-required-message="Selecione uma opção"> Sim
							<input type="radio"	name="ativo" id="ativonao" value="Não" required
							data-validation-required-message="Selecione uma opção"> Não
							</div>
							</div>
							</div>
							<script type="text/javascript">
							<?php
								if ( $ativo == "Não" ) {
								echo "$('#ativonao').prop('checked',true)";
								} else {
								echo "$('#ativosim').prop('checked',true)";
								}


								if ($permisao = "admin"){
									echo "$('#admin').prop('checked',true)";
								}else{
									echo "$('#funcionario').prop('checked'),true)";
								}
							?>
							</script>
					</fieldset>
						<button type="submit" class="btn center-block btn-lg btn-success">Salvar Dados</button>
						</form>
				</div>	
			</div>
		</div>
	</div>	
				
		
<script>

    $('.input-group.date').datepicker({
    	format: 'dd/mm/yyyy',
    	language: 'pt-BR',
    	autoclose: true,
    	startView: 2
    	
    });

//Aplica a máscara no campo
//Função para ser utilizada nos eventos do input para formatação dinâmica
function aplica_mascara_cpfcnpj(campo,tammax,teclapres) {
	var tecla = teclapres.keyCode;

	if ((tecla < 48 || tecla > 57) && (tecla < 96 || tecla > 105) && tecla != 46 && tecla != 8) {
		return false;
	}

	var vr = campo.value;
	vr = vr.replace( /\//g, "" );
	vr = vr.replace( /-/g, "" );
	vr = vr.replace( /\./g, "" );
	var tam = vr.length;

	if ( tam <= 2 ) {
		campo.value = vr;
	}
	if ( (tam > 2) && (tam <= 5) ) {
		campo.value = vr.substr( 0, tam - 2 ) + '-' + vr.substr( tam - 2, tam );
	}
	if ( (tam >= 6) && (tam <= 8) ) {
		campo.value = vr.substr( 0, tam - 5 ) + '.' + vr.substr( tam - 5, 3 ) + '-' + vr.substr( tam - 2, tam );
	}
	if ( (tam >= 9) && (tam <= 11) ) {
		campo.value = vr.substr( 0, tam - 8 ) + '.' + vr.substr( tam - 8, 3 ) + '.' + vr.substr( tam - 5, 3 ) + '-' + vr.substr( tam - 2, tam );
	}
	if ( (tam == 12) ) {
		campo.value = vr.substr( tam - 12, 3 ) + '.' + vr.substr( tam - 9, 3 ) + '/' + vr.substr( tam - 6, 4 ) + '-' + vr.substr( tam - 2, tam );
	}
	if ( (tam > 12) && (tam <= 14) ) {
		campo.value = vr.substr( 0, tam - 12 ) + '.' + vr.substr( tam - 12, 3 ) + '.' + vr.substr( tam - 9, 3 ) + '/' + vr.substr( tam - 6, 4 ) + '-' + vr.substr( tam - 2, tam );
	}
}

//Verifica se CPF ou CGC e encaminha para a devida função, no caso do cpf/cgc estar digitado sem mascara
function verifica_cpf_cnpj(cpf_cnpj) {
	if (cpf_cnpj.length == 11) {
		return(verifica_cpf(cpf_cnpj));
	} else if (cpf_cnpj.length == 14) {
		return(verifica_cnpj(cpf_cnpj));
	} else { 
		return false;
	}
	return true;
}

//Verifica se o número de CPF informado é válido
function verifica_cpf(sequencia) {
	if ( Procura_Str(1,sequencia,'00000000000,11111111111,22222222222,33333333333,44444444444,55555555555,66666666666,77777777777,88888888888,99999999999,00000000191,19100000000') > 0 ) {
		return false;
	}
	seq = sequencia;
	soma = 0;
	multiplicador = 2;
	for (f = seq.length - 3;f >= 0;f--) {
		soma += seq.substring(f,f + 1) * multiplicador;
		multiplicador++;
	}
	resto = soma % 11;
	if (resto == 1 || resto == 0) {
		digito = 0;
	} else {
		digito = 11 - resto;
	}
	if (digito != seq.substring(seq.length - 2,seq.length - 1)) {
		return false;
	}
	soma = 0;
	multiplicador = 2;
	for (f = seq.length - 2;f >= 0;f--) {
		soma += seq.substring(f,f + 1) * multiplicador;
		multiplicador++;
	}
	resto = soma % 11;
	if (resto == 1 || resto == 0) {
		digito = 0;
	} else {
		digito = 11 - resto;
	}
	if (digito != seq.substring(seq.length - 1,seq.length)) {
		return false;
	}
	return true;
}

//Verifica se o número de CNPJ informado é válido
function verifica_cnpj(sequencia) {
	seq = sequencia;
	soma = 0;
	multiplicador = 2;
	for (f = seq.length - 3;f >= 0;f-- ) {
		soma += seq.substring(f,f + 1) * multiplicador;
		if ( multiplicador < 9 ) {
			multiplicador++;
		} else {
			multiplicador = 2;
		}
	}
	resto = soma % 11;
	if (resto == 1 || resto == 0) {
		digito = 0;
	} else {
		digito = 11 - resto;
	}
	if (digito != seq.substring(seq.length - 2,seq.length - 1)) {
		return false;
	}

	soma = 0;
	multiplicador = 2;
	for (f = seq.length - 2;f >= 0;f--) {
		soma += seq.substring(f,f + 1) * multiplicador;
		if (multiplicador < 9) {
			multiplicador++;
		} else {
			multiplicador = 2;
		}
	}
	resto = soma % 11;
	if (resto == 1 || resto == 0) {
		digito = 0;
	} else {
		digito = 11 - resto;
	}
	if (digito != seq.substring(seq.length - 1,seq.length)) {
		return false;
	}
	return true;
}

//Procura uma string dentro de outra string
function Procura_Str(param0,param1,param2) {
	for (a = param0 - 1;a < param1.length;a++) {
		for (b = 1;b < param1.length;b++) {
			if (param2 == param1.substring(b - 1,b + param2.length - 1)) {
				return a;
			}
		}
	}
	return 0;
}

//Retira a máscara do valor de cpf_cnpj
function retira_mascara(cpf_cnpj) {
	return cpf_cnpj.replace(/\./g,'').replace(/-/g,'').replace(/\//g,'')
}


</script>
