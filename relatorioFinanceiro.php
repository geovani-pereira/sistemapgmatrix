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
    $data1 = $data2 = $dt1 = $dt2 = $filtro = "";
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
                    <i class="fa fa-area-chart" aria-hidden="true"></i> RELATÓRIO FINANCEIRO</h4>
            </div>


            <div class="panel-body">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#home" aria-controls="home" role="tab" data-toggle="tab"><i class="fa fa-usd" aria-hidden="true"></i> Receita</a>
                    </li>
                    <li role="presentation">
                        <a href="#contas" aria-controls="contas" role="tab" data-toggle="tab"><i class="fa fa-line-chart" aria-hidden="true"></i>Despesas</a>
                    </li>
                    <li role="presentation">
                        <a href="#destaques" aria-controls="destaques" role="tab" data-toggle="tab"><i class="fa fa-times-circle" aria-hidden="true"></i> Despesas em Prioridades</a>
                    </li>
                    <li role="presentation">
                        <a href="#filtrodata" aria-controls="filtrodata" role="tab" data-toggle="tab"><i class="fa fa-calendar" aria-hidden="true"></i> Filtro Geral por Data</a>
                    </li>
                </ul> <br><br>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="home">
                        <form name="form1" method="get" action="listaRelatorioReceita.php" enctype="multipart/form-data" novalidate>
                            <fieldset>
                                <div class="col-md-2">
                                    <div class="control-group">
                                        <label for="filtro">Filtro de Receita:</label>
                                        <div class="controls">
                                            <select name="filtro" id="filtro" class="form-control" required
                                                data-validation-required-message="Selecione o Filtro">
                                                <option value="tc">Todas</option>
                                            </select>
                                        </div>
                                        <script type="text/javascript">
                                            $("#filtro").val("<?=$filtro;?>");
                                        </script>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="control-group">
                                        <label for="dt1" class="control-label">Inicio:</label>
                                        <div class="input-group date">
                                            <input type="text" 
                                                name="dt1" id="datetimepicker1"
                                                class="form-control"
                                                value="<?=$dt1;?>" >
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="control-group">
                                        <label for="dt2" class="control-label">Fim:</label>
                                        <div class="input-group date">
                                            <input type="text" 
                                                name="dt2" id="datetimepicker1"
                                                class="form-control"
                                                value="<?=$dt2;?>" >
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>      
                            <button type="submit" class="btn center-block btn-success btn-lg">Filtrar</button>
                        </form>
                    </div> <!-- fecha aba de contas -->

             
                
                    <div role="tabpanel" class="tab-pane" id="contas">
                        <form name="form1" method="get" action="listaRelatorioContas.php" enctype="multipart/form-data" novalidate>
                            <fieldset>
                                <div class="col-md-2">
                                    <div class="control-group">
                                        <label for="filtro">Filtro de Despesas:</label>
                                        <div class="controls">
                                            <select name="filtro" id="filtro" class="form-control" required
                                                data-validation-required-message="Selecione o Filtro">
                                                <option value="tc">Todas</option>
                                                <option value="go">Pago</option>
                                                <option value="pa">Pendente</option>
                                            </select>
                                        </div>
                                        <script type="text/javascript">
                                            $("#filtro").val("<?=$filtro;?>");
                                        </script>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="control-group">
                                        <label for="dt1" class="control-label">Inicio:</label>
                                        <div class="input-group date">
                                            <input type="text" 
                                                name="dt1" id="datetimepicker1"
                                                class="form-control"
                                                value="<?=$dt1;?>" >
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="control-group">
                                        <label for="dt2" class="control-label">Fim:</label>
                                        <div class="input-group date">
                                            <input type="text" 
                                                name="dt2" id="datetimepicker1"
                                                class="form-control"
                                                value="<?=$dt2;?>" >
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>      
                            <button type="submit" class="btn center-block btn-success btn-lg">Filtrar</button>
                        </form>
                    </div> <!-- fecha aba de contas -->
                    
                    <!-- abre contas em destaques -->

                     <div role="tabpanel" class="tab-pane" id="destaques">
                        <form action="listaRelatorioContas.php" method="get">
                            <div class="panel-body">
                                <div class="clearfix"></div>
                                <fieldset>
                                    <div class="col-md-2">
                                        <div class="control-group">
                                            <label for="filtro">Filtro de Despesas:</label>
                                            <div class="controls">
                                                <select name="filtro" id="filtro" class="form-control" required
                                                    data-validation-required-message="Selecione o Filtro">
                                                    <option value="ve">Vencidas</option>
                                                    <option value="ul">Último prazo Vencimento</option>
                                                </select>
                                            </div>
                                            <script type="text/javascript">
                                                $("#filtro").val("<?=$filtro;?>");
                                            </script>
                                        </div>
                                    </div>
                                </fieldset>     
                                <button type="submit" class="btn center-block btn-success btn-lg">Filtrar</button>
                            </div>
                        </form>
                    </div> 

                    <!-- fecha contas em destaques -->   


                    <!-- TABELA PAINEL RELATORIO POR DATA -->
                    <div role="tabpanel" class="tab-pane" id="filtrodata">
                        <form action="reldata.php?act=view" method="post">
                            <div class="panel-body">
                                <div class="clearfix"></div>
                                <fieldset>
                                    <div class="panel-body">
                                        <div class="col-md-2">
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
                                    </div>
                                </fieldset>
                                <fieldset>
                                    <div class="panel-body">
                                        <div class="col-md-2">
                                            <div class="control-group">
                                                    <label for="data2" class="control-label">
                                                    Até a Data</label>
                                                <div class="input-group date">
                                                    <input type="text" 
                                                        name="data2" id="datetimepicker1"
                                                        class="form-control"
                                                        required 
                                                        data-validation-required-message="Preencha a segunda Data"
                                                        value="<?=$data2;?>" >
                                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>     
                                <button type="submit" class="btn center-block btn-success btn-lg">Filtrar</button>
                            </div>
                        </form>
                    </div> <!-- FECHA PAINEL FILTRAR POR DATA -->  
                </div>                    
            </div><!--panel-body-->	
        </div><!--panel panel edt-->
    </div> <!--container-fluid-->
</div><!--wrapper-->
<script>
    $('.input-group.date').datepicker({
    format: 'dd/mm/yyyy',
    language: 'pt-BR',
    weekStart: 0,
    autoclose: true
    });
</script>
</body>
</html>