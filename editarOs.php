<?php
    session_start();
        
        $permissao = $_SESSION["usuario"]["permissao"];
        if( $permissao == 'admin'){
            include "menu.php";
        
        }else{
            include "menufunc.php";
        }

$id = $datainicial = $datafinal = $descricao = $observacao = $cliente = $usuario = $status = "";

$datainicial = date("d/m/Y");
$datafinal = date("d/m/Y");
//verificar se está editando
if (isset($_GET["os"])) {

    //recuperar o id por get
    $id = trim($_GET["os"]);
    //selecionar os dados do banco
    $sql = "select os.*, date_format(datainicial,'%d/%m/%Y') dtini, date_format(datafinal,'%d/%m/%Y') dtfim, c.nome from ordem os inner join cliente c on (c.id = os.id_cliente) where os.id = ? limit 1";

    //prepare
    $consulta = $pdo->prepare($sql);
    //passar um parametro
    $consulta->bindParam(1, $id);
    //executa
    $consulta->execute();
    //separar os dados
    $dados = $consulta->fetch(PDO::FETCH_OBJ);

    $id = $dados->id;
    $datainicial = $dados->dtini;
    $datafinal = $dados->dtfim;
    $descricao = $dados->descricao;
    $status = $dados->status;
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
                    <i class="glyphicon glyphicon-search"></i> Listar Ordens
                </a>

                <div class="clearfix"></div>


                <div>

                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#ordemDeServico" aria-controls="ordem_de_servico" role="tab" data-toggle="tab">Ordem de Serviço</a></li>
                        <li role="presentation"><a href="#adicionarServico" aria-controls="adicionarServico" role="tab" data-toggle="tab">Serviços</a></li>
                        <li role="presentation"><a href="#adicionarProduto" aria-controls="adicionarProduto" role="tab" data-toggle="tab">Produtos</a></li>
                    </ul>

                    <br>


                    <div class="tab-content">             
                        <div role="tabpanel" class="tab-pane active" id="ordemDeServico">                   
                            <form name="formcadastro" method="post" action="salvarOs.php" novalidate>			
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="control-group">
                                            <label for="id">ID:</label>
                                            <div class="controls">
                                                <input type="text" name="id"
                                                       class="form-control"
                                                       readonly
                                                       value="<?= $id; ?>">
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
                                                       value="<?= $datainicial; ?>">
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
                                                       value="<?= $datafinal; ?>" >
                                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                            </div>
                                        </div>
                                    </div>

                                    <script>
                                        $('.input-group.date').datepicker({
                                            format: 'dd/mm/yyyy',
                                            language: 'pt-BR',
                                            weekStart: 0,
                                            startDate: '0d',
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

                                </div>
                                <div class="row">
                                    <div class="col-md-9">
                                        <div class="control-group">
                                            <label for="descricao">Descrição</label>
                                            <div class="controls"><input type="text" name="descricao" class="form-control" required 
                                                                         data-validation-required-message="Preencha a descricão do serviço" maxlength="255" placeholder="Digite a descrição da ordem serviço" value="<?= $descricao; ?>">
                                            </div>
                                        </div>
                                    </div>                       

                                    <div class="col-md-3">
                                        <div class="control-group">
                                            <label class="control-label">Status</label>
                                            <div class="controls">
                                                <select name="status" id="status" required data-validation-required-message="Selecione um Status" class="form-control">
                                                    <option value=""></option>
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
                                            <div class="controls"><textarea type="text" name="observacao" class=" form-control" maxlength="255" placeholder="Digite as observações da ordem de serviço" value="<?= $observacao; ?>"><?= $observacao; ?></textarea>
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
                                                   readonly required value="<?= $id_cliente; ?>">
                                            <input type="text" name="cliente" id="cliente" class="form-control input2" placeholder="Digite o nome do cliente" value="<?= $cliente ?>">
                                        </div> <!-- controls -->
                                    </div> <!-- col-md -->
                                    <div class="col-md-6">
                                        <div class="control-group">
                                            <label class="control-label">Usuário:</label>
                                            <div class="controls">
                                                <input type="text" name="id_usuario"
                                                       class="form-control input1 hidden" readonly
                                                       value="<?= $_SESSION["usuario"]["id"]; ?>">
                                                <input type="text" readonly value="<?= $_SESSION['usuario']['nome'] ?>" class="form-control">
                                            </div> <!-- controls -->
                                        </div>							
                                    </div>	
                                </div>
                                <br>
                                <div class="row" align="center">
                                    <button type="submit" class="btn btn-success">Salvar Alterações</button>                                    
                                    <a href="visualizarOs.php?os=<?=$id?>" class="btn btn-warning">Visualizar OS</a>
                                    <a href="listarOs.php" class="btn btn-danger">Voltar</a>
                                    <a href="faturar.php?os=<?=$id?>" class="btn btn-primary"><i class="glyphicon glyphicon-usd"></i>Faturar</a>

                                </div>
                                <div class="clearfix"></div>
                            </form>
                        </div>

                        <div role="tabpanel" class="tab-pane" id="adicionarServico">                 
                            <form name="form2" method="post" action="adicionars.php" target="iframe">

                                <input type="hidden" name="os_id" value="<?= $id ?>">
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="id_servico">ID:</label>
                                            <input type="text" name="id_servico"
                                                   id="id_servico" class="form-control" readonly required>
                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="form-group">
                                            <label for="servico">Serviço:</label>
                                            <input type="text" name="servico" id="servico" class="form-control"
                                                   placeholder="Digite o nome do Serviço" data-validation-required-message="Preencha o Serviço">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="valor">Valor:</label>
                                            <input type="text" name="valor" id="valor" class="form-control valor">
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-success" id="btnAdd">Adicionar</button>

                                </div>
                            </form>
                            <iframe name="iframe" src="adicionars.php?os=<?= $id; ?>"
                                    width="100%" height="300px" 
                                    class="thumbnail"></iframe> 
                        </div>

                        <div role="tabpanel" class="tab-pane" id="adicionarProduto">                 
                            <form name="form3" method="post" action="adicionarp.php" target="iframep">
                                <input type="hidden" name="os_id" value="<?= $id ?>">

                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="id_produto">ID:</label>
                                            <input type="text" name="id_produto"
                                                   id="id_produto" class="form-control" readonly required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="produto">Produto:</label>
                                            <input type="text" name="produto" id="produto" class="form-control"
                                                   placeholder="Digite o nome do Produto" data-validation-required-message="Preencha o Produto">
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="quantidade">Quantidade:</label>
                                            <input type="number" name="quantidade" id="quantidade" class="form-control">
                                        </div>
                                    </div>


                                    <button type="submit" class="btn btn-success" id="btnAdd">Adicionar</button>

                                </div>
                            </form>
                            <div class="responsive">
                            <iframe name="iframep" src="adicionarp.php?os=<?= $id; ?>"
                                    width="100%" height="300px" 
                                    class="thumbnail"></iframe> 
                            </div>
                        
                        </div>

                    </div>                    
                </div>                    
            </div><!--panel-body-->	
        </div><!--panel panel edt-->
    </div> <!--container-fluid-->
</div><!--wrapper-->


<script type="text/javascript" src="js/jquery.easy-autocomplete.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/easy-autocomplete.min.css">

<script type="text/javascript">

                                        $("#status").val("<?= $status; ?>");
                                                                                
                                        //configurar as opcoes da busca
                                        options = {
                                            url: "clientes.php", //arquivo a consultar
                                            getValue: function (element) {
                                                return element.nome;
                                                //objeto de pesquisa - nome do cliente
                                            },
                                            list: {
                                                maxNumberOfElements: 5,
                                                //numero maximo de resultados da busca
                                                match: {
                                                    enabled: true
                                                            //trazer somente os resultados iguais
                                                },
                                                onClickEvent: function () {
                                                    //jogar o id do nome selecionado no campo cliente_id
                                                    item = $("#cliente").getSelectedItemData().id;
                                                    //jogar o valor no campo
                                                    $("#id_cliente").val(item).trigger("change");
                                                }
                                            }
                                        };
                                        //adicionar a funcao ao campo
                                        $("#cliente").easyAutocomplete(options);


                                        //configurar as opcoes da busca do autocomplete
                                        options = {
                                            url: "produtos.php", //arquivo a consultar
                                            getValue: function (element) {
                                                return element.nome;
                                                //objeto de pesquisa - titulo do filme
                                            },
                                            list: {
                                                maxNumberOfElements: 5,
                                                //numero maximo de resultados da busca
                                                match: {
                                                    enabled: true
                                                            //trazer somente os resultados iguais
                                                },
                                                onClickEvent: function () {
                                                    //jogar o id do nome selecionado no campo id_produto
                                                    item = $("#produto").getSelectedItemData().id;
                                                    //jogar o valor no campo
                                                    $("#id_produto").val(item).trigger("change");
                                                }
                                            }
                                        };
                                        //adicionar a funcao ao campo
                                        $("#produto").easyAutocomplete(options);
</script>

<script type="text/javascript">
    //configurar as opcoes da busca do autocomplete
    options = {
        url: "servicos.php", //arquivo a consultar
        getValue: function (element) {
            return element.nome;
            //objeto de pesquisa - titulo do servico
        },
        list: {
            maxNumberOfElements: 5,
            //numero maximo de resultados da busca
            match: {
                enabled: true
                        //trazer somente os resultados iguais
            },
            onClickEvent: function () {
                //jogar o id do nome selecionado no campo filme_id
                item = $("#servico").getSelectedItemData().id;
                item2 = $("#servico").getSelectedItemData().valor;

                function numeroParaMoeda(n, c, d, t)
                {
                    c = isNaN(c = Math.abs(c)) ? 2 : c, d = d == undefined ? "," : d, t = t == undefined ? "." : t, s = n < 0 ? "-" : "", i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "", j = (j = i.length) > 3 ? j % 3 : 0;
                    return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
                }
                item2 = numeroParaMoeda(item2);
//               item2 = parseFloat(item2).toFixed(2);
//               item2 = item2.toLocaleString("pt-BR", { style: "currency" , currency:"BRL"});

                console.log(item2);
                //jogar o valor no campo
                $("#id_servico").val(item).trigger("change");
                $("#valor").val(item2).trigger("change");
            }
        }
    };
    //adicionar a funcao ao campo
    $("#servico").easyAutocomplete(options);
</script>


