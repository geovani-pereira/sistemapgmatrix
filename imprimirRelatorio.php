<link href="css/print.css" rel="stylesheet">
<div id="wrapper">

    <div class="panel panel-edt imprimir">    
        <div class="panel-body panel-edt4">
            <h2 class="text-center"> Relatorio de Produtos</h2>
            <div class="row">
                <div class="col-md-4 col-sm-4 col-xs-4">
                    <img src="imagens/logo.png" class="img-responsive" width="250px">
                </div>
                <div class="col-md-8 col-sm-8 col-xs-8 text-right">
                    <p><strong>PG Matrix - Orçamentos Online</strong><br>
                        Av Duque de Caxias 5757<br> Alto São Francisco<br>
                        Umuarama - PR<br/> (44) 9 - 9999 - 9889</p>
                </div>
            </div> 

            <div class="clearfix"></div>
            <hr>

            <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6">
                <h4>Cliente: <b><?=$nome?></b></h4>
            </div> 

            <div class="col-md-6 col-lg-6 col-sm-5 col-xs-5 text-right">
                <h4>Nº: <b><?=$id?></b></h4>
            </div>

            <div class="clearfix"></div>

            <div class="row"> 

                <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6">                 
                    
                </div>

                <div class="col-md-6 col-lg-6 col-sm-5 col-xs-5 text-right" data-mh="col-md-6">

                    
                </div>

            </div>
<hr>
            <div class="row">
                <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">

                    
                    
                   
                   
                </div>
            </div>
            <hr>
            
             <div class="row">
                <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">

                    
                    <strong>Observação:</strong>
                    <p><?=$observacao?></p>
                   
                   
                </div>
            </div>
            <hr>
            <div class="col-md-12">
                <div class="row">
                    <table class="table table-striped table-bordered">
                        <strong>Produtos:</strong>
                        <thead>
                            <tr>
                                <th scope="col" width="2%">ID</th>
                                <th scope="col" width="25%">Quantidade</th>
                                <th scope="col">Produto</th>
                                <th scope="col">Valor</th>
                                <th scope="col" width="11%">SubTotal</th>
                            </tr>
                        </thead>
                        
				<tbody>
                <tr>
					<th scope ='row'>$id_produto</th>
                    <td>$quantidade</td>
					<td>$nome</td>  
                    <td>$valor</td>    
                    <td>$v</td>			                          
				</tr>                                
				
                            
                            
                        </tbody>
                    </table>
                </div>
            </div>


            <div class="col-md-12">
                <div class="row">
                    <table class="table table-striped table-bordered">
                        <strong>Serviços:</strong>
                        <thead>
                            <tr>
                                <th scope="col" width="2%">ID</th>
                                <th scope="col">Serviço</th>
                                <th scope="col">Descrição</th>
                                <th scope="col">Valor</th>
                            </tr>
                        </thead>
                
				<tr>                                
                    <th scope='row'>$id_servico</th>                                      
					<td>$nome</td>
                    <td>$descricao</td>
                    <td>R$ $valor</td>     
				</tr>
				
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                        <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6 grayy">
                            <span>Valor Total:</span>
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-5 col-xs-5 text-right grayy">
                            <strong>R$ <?=$total?></strong>
                        </div>
                    </div>
            <button class="btn btn-success pull-right" id="imprimir" onclick="javascript:impresso()">Imprimir</button>
            <div id="faturar">
          
            </div>
        </div>
    </div>



</div>
<script src="js/jquery.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.matchHeight/0.7.0/jquery.matchHeight-min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>

<script>
                function impresso() {

                    var imprimir = document.getElementById("imprimir");
                    document.getElementById("faturar").style.display = "none";
                    imprimir.style.display = "none";
                    
                    window.print();

                }
                

                function faturar(id) {
                //enviar o id para uma página
                location.href = "faturar.php?os="+id;
            
        }

</script>