<?php
	//incluir o menu
	session_start();
		
		$permissao = $_SESSION["usuario"]["permissao"];
		if( $permissao == 'admin'){
			include "menu.php";
			
		}else{
			include "menufunc.php";
		}
$id = $datainicial = $datafinal = $descricao = $observacao = $cliente = $usuario = $status = $recebido = "";

$datainicial = date("d/m/Y");
$datafinal = date("d/m/Y");
	//verificar se está editando
if ( isset ( $_GET["id"] ) ) {

		//recuperar o id por get
	$id = trim( $_GET["id"] );
		//selecionar os dados do banco
	$sql = "select os.*, date_format(datainicial,'%d/%m/%Y') dtini, date_format(datafinal,'%d/%m/%Y') dtfim, c.nome from ordem os inner join cliente c on (c.id = os.id_cliente) where os.id = ? limit 1";

		//prepare
	$consulta = $pdo->prepare( $sql );
		//passar um parametro
	$consulta->bindParam( 1, $id );
		//executa
	$consulta->execute();
		//separar os dados
	$dados = $consulta->fetch(PDO::FETCH_OBJ);

	$id = $dados->id;
	$datainicial = $dados->dtini;
	$datafinal = $dados->dtfim;
	$descricao = $dados->descricao;
	$status = $dados->status;
	$recebido = $dados->recebido;
	$observacao = $dados->observacao;
	$cliente = $dados->nome;
	$id_cliente = $dados->id_cliente;
	$id_usuario = $dados->id_usuario;




}


?>
<div id="wrapper">
	<div class="container-fluid">
		<div class="panel panel-edt">
			<div class="panel-heading panel-edt2">
				<h4 class="text-center panel-edt3">
					<i class="glyphicon glyphicon-plus-sign"></i>CADASTRO DE ORDEM DE SERVIÇO</h4>
				</div>

				<div class="panel-body">
					<a href="cadastroOs.php" class="btn btn-default pull-right"">
						<i class="glyphicon glyphicon-file"></i> Nova Ordem
					</a>
					<br><br>
					<a href="listarOs.php" class="btn btn-default pull-right"">
						<i class="glyphicon glyphicon-search"></i> 
						Listar Ordens
					</a>

					<div class="clearfix"></div>


					<div>
						<ul class="nav nav-tabs">
							<li role="presentation" class="active"><a href="#">Ordem de Serviço</a></li>

						</ul>
					</div>

					<form name="formcadastro" method="post" action="salvarOs.php" novalidate>			
						<div class="row">
							<div class="col-md-4">
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
							<div class="col-md-4">
								<div class="control-group">
									<label for="datainicial" class="control-label">
									Data Inicial</label>
									<div class="input-group date">
										<input type="text" 
										name="datainicial" id="datetimepicker1"
										class="form-control"
										required 
										data-validation-required-message="Preencha a Inicial"
										value="<?=$datainicial;?>">
										<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="control-group">
									<label for="datafinal" class="control-label">
									Data Final</label>
									<div class="input-group date">
										<input type="text" 
										name="datafinal" id="datetimepicker1"
										class="form-control"
										required
										data-validation-required-message="Preencha a Inicial"
										value="<?=$datafinal;?>" >
										<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
									</div>
								</div>
							</div>			
							
						</div>
						<div class="row">
							<div class="col-md-9">
								<div class="control-group">
									<label for="descricao">Descrição</label>
									<div class="controls"><input type="text" name="descricao" class="form-control" required 
										data-validation-required-message="Preencha a descricão do serviço" maxlength="255" placeholder="Digite a descrição da ordem serviço" value="<?=$descricao;?>">
									</div>
								</div>
							</div>


							

							<div class="col-md-3">
								<div class="control-group">
									<label class="control-label">Status</label>
									<div class="controls">
										<select name="status" id="status" required data-validation-required-message="Selecione um Status" class="form-control">											
											<option value="Aberto">Aberto</option>
											<option value="Em Andamento">Em Andamento</option>
											<option value="Cancelado">Cancelado</option>
											<option value="Finalizado">Finalizado</option>
											<option value="Orçamento">Orçamento</option>
										</select>
									</div>
								</div>
							</div>

							<div class="col-md-12">
								<div class="control-group">
									<label for="observacao">Observações</label>
									<div class="controls"><textarea type="text" name="observacao" class=" form-control" maxlength="255" placeholder="Digite as observações da ordem de serviço"><?=$observacao?></textarea>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<label class="control-label">Cliente:</label>
								<div class="controls">
									<input type="text" name="id_cliente"
									id="id_cliente" class="form-control input1 hidden"
									readonly required value="<?=$id_cliente;?>">
									<input type="text" name="cliente" id="cliente" class="form-control input2" placeholder="Digite o nome do cliente" required value="<?=$cliente?>">
								</div> <!-- controls -->
							</div> <!-- col-md -->
							<div class="col-md-6">
								<div class="control-group">
									<label class="control-label">Usuário:</label>
									<div class="controls">
										<input type="text" name="id_usuario"
										class="form-control input1 hidden" readonly
										value="<?=$_SESSION["usuario"]["id"];?>">
										<input type="text" readonly value="<?=$_SESSION['usuario']['nome']?>" class="form-control">
									</div> <!-- controls -->
								</div>							
							</div>	
						</div>
						<br>
						<button type="submit" id="submit" name="botao" class="btn center-block btn-lg btn-success">Continuar</button>
						<div class="clearfix"></div>
					</form>
				</div><!--panel-body-->	
			</div><!--panel panel edt-->
		</div> <!--container-fluid-->
	</div><!--wrapper-->
	

	<script type="text/javascript" src="js/jquery.easy-autocomplete.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/easy-autocomplete.min.css">
			
	<script type="text/javascript">

 $(document).ready(function() {
        $("#submit").mouseover(function() {
        	
var cliente = formcadastro.cliente.value;
var descricao = formcadastro.descricao.value;
 
if (cliente == "") {
alert('Preencha o campo cliente.');
return false;
}else if(descricao == ""){
	alert('Preencha o campo descrição.');
}
})
           
        });

    



		$('.input-group').datepicker({
									format: 'dd/mm/yyyy',
									language: 'pt-BR',
									weekStart: 0,
									startDate:'0d',
									autoclose: true,
									todayBtn: "linked",
									orientation: 'bottom'
								});

		$("#status").val("<?=$status;?>");
	//configurar as opcoes da busca
	options = {
		url : "clientes.php", //arquivo a consultar
		getValue: function ( element ) {
			return element.nome;                        
			//objeto de pesquisa - nome do cliente
		},
		list : {
			maxNumberOfElements : 5,
			//numero maximo de resultados da busca
			match : {
				enabled : true
				//trazer somente os resultados iguais
			},
			onSelectItemEvent: function() {
				//jogar o id do nome selecionado no campo cliente_id
				item = $("#cliente").getSelectedItemData().id;
				//jogar o valor no campo
				$("#id_cliente").val(item).trigger("change");
			}
		}
	};
	//adicionar a funcao ao campo
	$("#cliente").easyAutocomplete(options);

</script>

