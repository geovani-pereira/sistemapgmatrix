<?php
    //iniciar a sessao
    
    
    

    if ( !isset( $_SESSION["usuario"]["id"] ) ) {
        //direcionar para o index
        header( "Location: index.php" );
    }
    
    
    
    
 
    //incluir o arquivo para conectar no banco
    include "config/conecta.php";

    function formatarvalor($valor) {
        $valor = str_replace( ".", "", $valor);
        //busca - valor para substituir - variavel
    
        $valor = str_replace( ",", ".", $valor);
    
        //retornar um valor
        return $valor;
    }

    function formatardata($data) {
    // 29/09/2017 -> 2017-09-29
    $data = explode( "/", $data );
    $data = $data[2]."-".$data[1]."-".$data[0];
    return $data;
  }
  function dataformatar($data){
      $data = explode("-", $data);
      $data =$data[2]."/".$data[1]."/".$data[0];
      return $data;
  }
    
 
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>PG MATRIX</title>


    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/sb-admin.css" rel="stylesheet">
    <link href="css/plugins/morris.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="css/bootstrap-datepicker.css" rel="stylesheet">
    <link href="css/estilo.css" rel="stylesheet">

    <link href="css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="css/responsive.dataTables.min.css" rel="stylesheet">


 
    
   
    <!-- <link href="css/table.css" rel="stylesheet"> -->
   
    
</head>

<body>
    <div id="wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" 
                        data-target=".navbar-ex1-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="home.php"><img src="imagens/logogif3.gif"></a>
                </div>
                
                <div class="collapse navbar-collapse" id="menu">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown" id="olalogin">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" 
                                aria-haspopup="true" aria-expanded="false"><i class="fa fa-user"></i>  
                               Logado como: <?php echo $_SESSION["usuario"]["nome"];?>
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="editarUsuario.php?id=<?php echo $_SESSION["usuario"]["id"];?>"><i class="fa fa-fw fa-gear"></i> Alterar dados</a></li>
                                <li class="divider"></li>
                                <li><a href="sair.php"><i class="fa fa-fw fa-power-off fa-2x"></i> Sair</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
             <div class="collapse navbar-collapse navbar-ex1-collapse">
                    <ul class="nav navbar-nav side-nav">
                         <li>
                        <a href="produto.php"><i class="fa fa-archive fa-1x"></i> PRODUTOS</a>
                    </li>
                    <li>
                        <a href="listarServico.php"><i class="fa fa-handshake-o fa-1x"></i> SERVIÇOS</a>
                    </li>
                    <li>
                        <a href="cliente.php"><i class="fa fa-id-card-o fa-1x"></i> CLIENTES</a>
                    </li>
                    <li>
                         <a href="cadastroOs.php"><i class="fa fa fa-tags fa-1x"></i> ORDENS DE SERVIÇO</a>
                    </li>                    
                    </ul>                          
                    
             <!-- /.navbar-collapse -->
             </div>
        </nav>
     </div>
    <!-- fecha div #wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- tem que ser o js 1.9.1 para funcionar a paginação -->
    <script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
    <script type="text/javascript" src="js/bootstrap-inputmask.min.js"></script>
    <script type="text/javascript" src="js/summernote.min.js"></script>
    <script type="text/javascript" src="lang/summernote-pt-BR.js"></script>
    <script type="text/javascript" src="js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="js/datatables.min.js"></script>
    <script type="text/javascript" src="js/bootstrap-datepicker.min.js"></script>
    <script type="text/javascript" src="js/bootstrap-datepicker.pt-BR.min.js"></script>
    <script type="text/javascript" src="js/jqBootstrapValidation.js"></script>
    <script type="text/javascript" src="js/jquery.maskMoney.min.js"> </script>

    <script type="text/javascript" src="js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="js/dataTables.responsive.min.js"></script>

    <script>
    $(function () { 
      //validação dos campos
        $("input,select,textarea").not("[type=submit]").jqBootstrapValidation(); 
      //colocar a máscara nos campos .valor - classes
      $(".valor").maskMoney({
          thousands : ".",
          decimal: ","
      });
    } );
    </script>

 

</body>
</html>
