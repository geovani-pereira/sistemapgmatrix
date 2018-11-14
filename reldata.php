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


 ?>

<div id="wrapper">
    <div class="container-fluid">
        <div class="panel panel-edt">
            <div class="panel-heading panel-edt2">
                <h4 class="text-center panel-edt3">
                    <i class="glyphicon glyphicon-plus-sign"></i>RELATORIO FINANCEIRO</h4>
            </div>

            <div class="panel-body">
                <a href="relatorioFinanceiro.php" title="Relatorio" class="btn btn-success pull-right">
                    <i class="fa fa-chevron-left" aria-hidden="true"></i> Voltar
                </a>
                            <?php 

                                if(isset($_GET['act'])){
                                    if(isset($_POST['data1'])){

                                        //$data1 = trim( $_POST["data1"] );
                                        //$data1 = formatardata($data1);

                                        $data1 = $_POST['data1'];
                                        $data2 = $_POST['data2'];

                                        $dataIncio = $data1;
                                        $dataFim = $data2;

                                        //formatando as datas q vem do POST de 16/05 para 05-16
                                        $data1 = DateTime::createFromFormat("d/m/Y",$data1);
                                        $data1 = $data1->format("Y-m-d");
                                        $data2 = DateTime::createFromFormat("d/m/Y",$data2);
                                        $data2 = $data2->format("Y-m-d");

                                        // DESPESAS;;
                                        $sql = "select sum(valor) as contaPaga FROM conta where conta = 'pago' and data >= ? AND data <= ?;";
                                        $consulta = $pdo->prepare( $sql );
                                        //passar um parametro
                                        $consulta->bindParam( 1, $data1 );
                                        $consulta->bindParam( 2, $data2 );
                                        //executa
                                        $consulta->execute();
                                        //separar os dados
                                        $dados = $consulta->fetch(PDO::FETCH_OBJ);
                                        $contaPaga = $dados->contaPaga;
                                        if($contaPaga == ''){
                                            $contaPaga = 0;
                                        }

                                        // RECEITA
                                        $sql = "select sum(p.valor) receita from parcela p inner join ordem o on ( o.id = p.id_ordem ) where p.datapgto != '' and datapgto >= ? AND datapgto <= ?";
                                        $consulta = $pdo->prepare( $sql );
                                        //passar um parametro
                                        $consulta->bindParam( 1, $data1 );
                                        $consulta->bindParam( 2, $data2 );
                                        //executa
                                        $consulta->execute();
                                        //separar os dados
                                        $dados = $consulta->fetch(PDO::FETCH_OBJ);
                                        $receita = $dados->receita;
                                        if($receita == ''){
                                            $receita = 0;
                                        }
                                        
                                        $lucroTotal = ($receita - $contaPaga);

                                        ?>

                                        <script type="text/javascript" src="js/pieChart.js"></script>
                                                <script type="text/javascript">
                                                  google.charts.load('current', {'packages':['corechart']});
                                                  google.charts.setOnLoadCallback(drawChart);

                                                  function drawChart() {

                                                    var data = google.visualization.arrayToDataTable([
                                                      ['Descrição', 'Valor'],
                                                      ['Lucro Total',     <?php echo "$lucroTotal";?>],
                                                      ['Contas',      <?php echo "$contaPaga";?>],
                                                      ['Receita',  <?php echo "$receita";?>],
                                                    ]);

                                                    var options = {
                                                      title: 'Gráfico'
                                                    };

                                                    var chart = new google.visualization.PieChart(document.getElementById('piechart'));

                                                    chart.draw(data, options);
                                                  }
                                        </script>
                                        <?php

                                        $lucroTotal = number_format( $lucroTotal, 2, "," ,"." );
                                        $receita = number_format( $receita, 2, "," ,"." );
                                        $contaPaga = number_format( $contaPaga, 2, "," ,"." );

                                        //converter a data
                                        //$data1 = DateTime::createFromFormat("Y-m-d",$data1);
                                        //$data1 = $data1->format("d/m/Y");
                                        //$data2 = DateTime::createFromFormat("Y-m-d",$data2);
                                        //$data2 = $data2->format("d/m/Y");

                                        echo "
                                                 <div class='well col-md-6'>
                                                    <h2>Lucro Mensal</h2>
                                                    <p>De $dataIncio até $dataFim</p>

                                                    <div class='list-group'>
                                                        <div class='list-group-item'  style='background-color: #3366CC'>
                                                            <h4 style='color: #ffffff'>Lucro Total: $lucroTotal R$</h4>
                                                        </div>
                                                    </div>

                                                    <div class='list-group'>
                                                        <div class='list-group-item'  style='background-color: #FF9900'>
                                                            <h4 style='color: #ffffff'>Receita: $receita R$</h4>
                                                        </div>
                                                    </div>

                                                    <div class='list-group'>
                                                        <div class='list-group-item'  style='background-color: #DC3912'>
                                                            <h4 style='color: #ffffff'>Despesas: $contaPaga R$</h4>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class='table-responsive'>
                                                    <div class='table'>
                                                        <div>
                                                            <div id='piechart' style='width: 590px; height: 390px;'></div>
                                                        </div>
                                                    </div>
                                                </div>";

                                    }else{
                                        return;
                                    }
                                    return;
                                }
                            ?>

                            <!-- ____________________________________________________________________________-->
                            <?php
                                if (isset($_POST["data1"])) {
                                //recuperar a data digitada
                                $data1 = $_POST["data1"];
                                //mostrar a data

                                $data1 = DateTime::createFromFormat("d/m/Y",$data1);
                                $data1 = $data1->format("Y-m-d");
                                }
                                ?>

                                <?php
                                if (isset($_POST["data2"])) {
                                //recuperar a data digitada
                                $data2 = $_POST["data2"];
                                //mostrar a data

                                $data2 = DateTime::createFromFormat("d/m/Y",$data2);
                                $data2 = $data2->format("Y-m-d");
                                }
                            ?>
                                    
                            <!-- ____________________________________________________________________________-->
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function (){
        $('#datetimepicker1').datetimepicker({locale: 'pt-br', format: 'DD/MM/YYYY'});
        // format dd/mm/yy remove a hora na data
    });
</script>