<?php
session_start();

$permissao = $_SESSION["usuario"]["permissao"];
if( $permissao == 'admin'){
	include "menu.php";
}else{
	include "menufunc.php";
}

$id = $data = $nome = $rg = $cpfcnpj = $telefone = $email = $rua = 
$numero = $bairro = $cidade = $estado = $cep = "";


	//verificar se está editando
if ( isset ( $_GET["id"] ) ) {

		//recuperar o id por get
	$id = trim( $_GET["id"] );
		//selecionar os dados do banco
	$sql = "select *,date_format(nascimento,'%d/%m/%Y') dt from cliente where id = ? limit 1";
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
	$data = $dados->dt;
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
		<div class="panel panel-edt">
			<div class="panel-heading panel-edt2">
				<h4 class="text-center panel-edt3">
					<i class="glyphicon glyphicon-plus-sign"></i> CADASTRO DE CLIENTE</h4>
				</div>

				<div class="panel-body">

					<a href="cadastroCliente.php" class="btn btn-default pull-right">
						<i class="fa fa-refresh"></i> Resetar dados
					</a>
					<br><br>
					<a href="listarCliente.php" class="btn btn-default pull-right">
						<i class="glyphicon glyphicon-search"></i> Listar Clientes
					</a>

					<div class="clearfix"></div>

					<form name="formcadastro" method="post" action="salvarCliente.php" novalidate>
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

							<div class="col-md-8">
								<div class="control-group">
									<label for="nome">Nome Completo:</label>
									<div class="controls"><input type="text" name="nome" class="form-control" required 
										data-validation-required-message="Preencha o nome" maxlength="100" value="<?=$nome;?>">
									</div>
								</div>
							</div>

							<div class="col-md-3">
								<div class="control-group">
									<label for="data" class="control-label">
									Data de Nascimento:</label>
									<div class="input-group date">
										<input type="text" id="datetimepicker1"
										name="data"
										class="form-control"
										
										data-validation-required-message="Preencha a data de nascimento"
										value="<?=$data;?>" >
										<span class="input-group-addon">
											<span class="glyphicon glyphicon-calendar"></span>
										</span>
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

							<div class="col-md-4">
								<div class="control-group">
									<label for="rg">RG:</label>
									<div class="controls"><input type="text" name="rg" class="form-control" placeholder="Digite seu o RG" maxlength="20" value="<?=$rg;?>">
									</div>
								</div>
							</div>

							<div class="col-md-4">
								<div class="control-group">
									<label for="cpfcnpj">CPF/CNPJ:</label>
									<input type="text" name="cpfcnpj" onkeydown="javascript:return aplica_mascara_cpfcnpj(this,18,event)" onkeyup="javascript:return aplica_mascara_cpfcnpj(this,18,event)" 
									class="form-control cpfcnpj" maxlength="18" placeholder="Digite somente números" value="<?=$cpfcnpj;?>">
								</div>
							</div>
							

							<div class="col-md-4">
								<div class="control-group">
									<label for="telefone">Telefone:</label>
									<div class="controls"><input type="text" name="telefone" class="form-control" data-mask="(99)99999999?9" required data-validation-required-message="Preencha o Telefone" placeholder="Digite somente número" value="<?=$telefone;?>">
									</div>
								</div>
							</div>

							<div class="col-md-4">
								<div class="control-group">
									<label for="email">E-mail:</label>
									<div class="controls"><input type="email" name="email" class="form-control" required data-validation-required-message="Preencha o e-mail" data-validation-email-message="Digite um e-mail válido" value="<?=$email;?>">
									</div>
								</div>
							</div>

							<div class="col-md-2">
								<div class="control-group">
									<label for="cep">CEP:</label>
									<div class="controls"><input type="text" name="cep" class="form-control" id="cep" required 
										data-validation-required-message="Preencha o cep" data-mask="99999-999" maxlength="9" onblur="pesquisacep(this.value)" value="<?=$cep;?>">
									</div>
								</div>
							</div>

							<div class="col-md-4">
								<div class="control-group">
									<label for="rua">Rua:</label>
									<div class="controls"><input type="text" name="rua" class="form-control" id="rua" required 
										data-validation-required-message="Preencha a rua" maxlength="50" value="<?=$rua;?>">
									</div>
								</div>
							</div>

							<div class="col-md-3">
								<div class="control-group">
									<label for="bairro">Bairro:</label>
									<div class="controls"><input type="text" name="bairro" 
										class="form-control" id="bairro" required 
										data-validation-required-message="Preencha o bairro" maxlength="50" value="<?=$bairro;?>">
									</div>
								</div>
							</div>

							<div class="col-md-3">
								<div class="control-group">
									<label for="cidade">Cidade:</label>
									<div class="controls"><input type="text" name="cidade" 
										class="form-control" id="cidade" required 
										data-validation-required-message="Preencha a cidade" maxlength="50" value="<?=$cidade;?>">
									</div>
								</div>
							</div>

							<div class="col-md-2">
								<div class="control-group">
									<label for="estado">Estado: </label>
									<div class="controls"><input type="text" name="estado" 
										class="form-control" id="estado" required 
										data-validation-required-message="Preencha o estado" maxlength="2" value="<?=$estado;?>">
									</div>
								</div>
							</div>

							<div class="col-md-2">
								<div class="control-group">
									<label for="numero">Numero:</label>
									<div class="controls"><input type="text" name="numero" 
										class="form-control" required 
										data-validation-required-message="Preencha o numero" value="<?=$numero;?>">
									</div>
								</div>
							</div>
						</fieldset>
						<br>
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
    		//Preenche Endereço
    		function limpa_formulário_cep() {
            //Limpa valores do formulário de cep.
            document.getElementById('rua').value=("");
            document.getElementById('bairro').value=("");
            document.getElementById('cidade').value=("");
            document.getElementById('estado').value=("");
            
        }

        function meu_callback(conteudo) {
        	if (!("erro" in conteudo)) {
            //Atualiza os campos com os valores.
            document.getElementById('rua').value=(conteudo.logradouro);
            document.getElementById('bairro').value=(conteudo.bairro);
            document.getElementById('cidade').value=(conteudo.localidade);
            document.getElementById('estado').value=(conteudo.uf);
            
        } //end if.
        else {
            //CEP não Encontrado.
            limpa_formulário_cep();
            alert("CEP não encontrado.");
        }
    }
    
    function pesquisacep(valor) {

        //Nova variável "cep" somente com dígitos.
        var cep = valor.replace(/\D/g, '');

        //Verifica se campo cep possui valor informado.
        if (cep != "") {

            //Expressão regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;

            //Valida o formato do CEP.
            if(validacep.test(cep)) {

                //Preenche os campos com "..." enquanto consulta webservice.
                document.getElementById('rua').value="...";
                document.getElementById('bairro').value="...";
                document.getElementById('cidade').value="...";
                document.getElementById('estado').value="...";
                

                //Cria um elemento javascript.
                var script = document.createElement('script');

                //Sincroniza com o callback.
                script.src = 'https://viacep.com.br/ws/'+ cep + '/json/?callback=meu_callback';

                //Insere script no documento e carrega o conteúdo.
                document.body.appendChild(script);

            } //end if.
            else {
                //cep é inválido.
                limpa_formulário_cep();
                alert("Formato de CEP inválido.");
            }
        } //end if.
        else {
            //cep sem valor, limpa formulário.
            limpa_formulário_cep();
        }
    };



    //verifica cpf

    function verificaCpf(cpf) {
					//console.log( cpf );
					//mostrar a mascara
					$("#mascara").show();

					id = $("#id").val();

					$.get("verificaCpfCnpj.php",
						{cpfcnpj:cpfcnpj, id:id},
						function(dados) {
							if ( dados != "ok" ) {
								alert( dados );
								//focar no campo

								$("#cpfcnpj").focus();
								$("#cpfcnpj").val("");
							}
							
						})
				}

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



</script>
