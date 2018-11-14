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
   $dt1 = $dt2 = "";

    
    
         if ($permissao == "funcionario"){
            echo "<script>alert('Você não tem acesso a este nivel do sistema, entre em contato com o administrador');history.back();</script>";
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
                    <i class="fa fa-handshake-o fa-1x"></i> RELATÓRIO SERVIÇOS</h4>
            </div>


            <div class="panel-body">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#home" aria-controls="home" role="tab" data-toggle="tab"><i class="fa fa-handshake-o fa-1x" aria-hidden="true"></i> Serviços</a>
                    </li>
                </ul> <br><br>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="home">
                        <form name="form1" method="get" action="listaRelatorioServicos.php" enctype="multipart/form-data" novalidate>
                            <fieldset>
                                <div class="col-md-2">
                                    <div class="control-group">
                                        <label for="tipo">Filtro:</label>
                                        <div class="controls">
                                            <select name="tipo" id="tipo" class="form-control" required
                                                data-validation-required-message="Selecione o Filtro">
                                                <option value="tp">Serviços mais Realizados</option>
                                            </select>
                                        </div>
                                        <script type="text/javascript">
                                            $("#tipo").val("<?=$tipo;?>");
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