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
        }

    $data1 = $data2 = $id = $id_cliente = $cpfcnpj = $nome = $descricao = $observacao = $cliente = $usuario = $status = $recebido = $tipo =  "";

    if ( isset ( $_GET["id"] ) ) {

        //recuperar o id por get
        $id = trim( $_GET["id"] );
        //selecionar os dados do banco


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

<script type="text/javascript">
    $('#myTabs a').click(function (e) {
      e.preventDefault()
      $(this).tab('show')
    })
</script>

<div id="wrapper">
    <div class="container-fluid">
        <div class="panel panel-edt">
            <div class="panel-heading panel-edt2">
                <h4 class="text-center panel-edt3">
                    <i class="fa fa-pie-chart fa-1x"></i> RELATÓRIO CLIENTES</h4>
            </div>


            <div class="panel-body">
                <div>
                    <a href="relatorioClientes.php" class="btn btn-default pull-right">
                    <i class="fa fa-refresh"></i> Resetar dados 
                    </a>
                </div>  
                <div class="clearfix"></div>
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#home" aria-controls="home" role="tab" data-toggle="tab"><i class="fa fa-usd" aria-hidden="true"></i> Compras</a>
                    </li>
                </ul> <br><br>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="home">
                        <form name="form1" method="get" action="listaRelatorioCliente.php" enctype="multipart/form-data" novalidate>
                            <fieldset>
                                <div class="col-md-2">
                                    <div class="control-group">
                                        <label for="tipo">Filtro:</label>
                                        <div class="controls">
                                            <select name="tipo" id="tipo" class="form-control" required
                                                data-validation-required-message="Selecione o Filtro" onchange="exibir_ocultar(this)">
                                                <option value="pendente">Parcelas Pendente</option>
                                                <option value="total">Total em Débitos</option>
                                                <option value="clienteCompras">Total em Compras</option>  
                                            </select>
                                        </div>
                                        <script type="text/javascript">
                                            $("#tipo").val("<?=$tipo;?>");
                                        </script>
                                    </div>
                                </div>
                                <div id="mostrarNome">
	                                <div class="col-md-4">
		                                <label class="control-label" title="Filtrar por *CLIENTE é opcional"><i class="fa fa-info-circle">
		                                        </i> Buscar Por Nome: 
		                                </label>
		                                <div class="controls">
		                                    <input type="text" id="cliente" class="form-control input2" placeholder="Digite o nome do cliente"
		                                    value="<?=$nome;?>">
		                                </div> <!-- controls -->
		                            </div> <!-- col-md -->
	                        	</div>
	                        	<div id="MostrarCpf">
		                            <div class="col-md-2">
		                                <label class="control-label" title="CPF / CNPJ será carregado após digitar o *CLIENTE"><i class="fa fa-info-circle">
		                                        </i> CPF / CNPJ
		                                </label>
		                                <div class="controls">
		                                    <input type="text" name="cpfcnpj"
		                                    id="cpfcnpj" class="form-control input1"
		                                    readonly required value="<?=$cpfcnpj;?>">
		                                </div>
		                            </div>
		                        </div>
	                            <div id="mostrarData1"> 
	                                <div class="col-md-2">
	                                    <div class="control-group">
	                                        <label for="data1" class="control-label">Inicio:</label>
	                                        <div class="input-group date">
	                                            <input type="text"
	                                                name="data1" id="datetimepicker1"
	                                                class="form-control"
	                                                value="<?=$data1;?>" >
	                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>
	                            <div id="mostrarData2">
	                                <div class="col-md-2">
	                                    <div class="control-group">
	                                        <label for="data2" class="control-label">Fim:</label>
	                                        <div class="input-group date">
	                                            <input type="text" 
	                                                name="data2" id="datetimepicker1"
	                                                class="form-control"
	                                                value="<?=$data2;?>" >
	                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>
                            </fieldset>      
                            <button type="submit" class="btn center-block btn-success btn-lg">Filtrar</button>
                        </form>
                	</div> <!-- fecha aba de contas -->
                </div>                    
            </div><!--panel-body-->	
        </div><!--panel panel edt-->
    </div> <!--container-fluid-->
</div><!--wrapper-->
<script type="text/javascript" src="js/jquery.easy-autocomplete.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/easy-autocomplete.min.css">

<script type="text/javascript">

    $("#status").val("<?=$status;?>");
    //configurar as opcoes da busca
    options = {
        url : "relClientes.php", //arquivo a consultar
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
                item = $("#cliente").getSelectedItemData().cpfcnpj;
                //jogar o valor no campo
                $("#cpfcnpj").val(item).trigger("change");
            }
        }
    };
    //adicionar a funcao ao campo
    $("#cliente").easyAutocomplete(options);

    $('.input-group.date').datepicker({
    format: 'dd/mm/yyyy',
    language: 'pt-BR',
    weekStart: 0,
    autoclose: true
    });
</script>
<script type="text/javascript">
function exibir_ocultar(val) {
  if(val.value == 'clienteCompras') {
    document.getElementById('mostrarData1').style.display = 'none';
    document.getElementById('mostrarData2').style.display = 'none';
    document.getElementById('MostrarCpf').style.display = 'block';
    document.getElementById('mostrarNome').style.display = 'block';
  }
  else if(val.value == 'total') {
    document.getElementById('mostrarData1').style.display = 'block';
    document.getElementById('mostrarData2').style.display = 'block';
    document.getElementById('MostrarCpf').style.display = 'block';
    document.getElementById('mostrarNome').style.display = 'block';
  } else {
  	document.getElementById('mostrarData1').style.display = 'block';
    document.getElementById('mostrarData2').style.display = 'block';
    document.getElementById('MostrarCpf').style.display = 'block';
    document.getElementById('mostrarNome').style.display = 'block';
  }
};
</script>
</body>
</html>