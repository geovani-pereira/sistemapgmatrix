<?php
    session_start();
        
        $permissao = $_SESSION["usuario"]["permissao"];
        if( $permissao == 'admin'){
            include "menu.php";
        }else{
            include "menufunc.php";
        }
$valor = 0.0;
$totalprodutos = $totalservicos = $total = 0;


if ( $_GET ) {
		$id = trim( $_GET["os"] );

		$sql = "select os.*, date_format(datainicial,'%d/%m/%Y'), c.nome,c.rua,c.bairro,c.numero,c.cep,c.telefone,c.email,c.cpfcnpj,c.cidade,c.estado from ordem os inner join cliente c on (c.id = os.id_cliente) where os.id = ? limit 1";

		$consulta = $pdo->prepare($sql);
		$consulta->bindParam(1, $id);
		$consulta->execute();
		$dados = $consulta->fetch(PDO::FETCH_OBJ);

		//dados os
                $data = $dados->datainicial;
                $status = $dados->status;
                $observacao = $dados->observacao;
                $descricao = $dados->descricao;
                
                 //dados cliente
		        $nome = $dados->nome;
		        $rua = $dados->rua;
                $bairro = $dados->bairro;
                $numero = $dados->numero;
                $cep = $dados->cep;
                $telefone = $dados->telefone;
                $email = $dados->email;
                $cpf = $dados->cpfcnpj;
                $cidade = $dados->cidade;
                $estado = $dados->estado;
                     
               
                $data = date('d/m/Y', strtotime($data));
                $valor = number_format( $valor, 2, "," , ".");

	}


        
?>

        
     
<link href="css/print.css" rel="stylesheet">
<div id="wrapper">

    <div class="panel panel-edt imprimir">    
        <div class="panel-body panel-edt4">
            <h2 class="text-center"> ORDEM DE SERVIÇO</h2>
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
                    <p>Email: <?=$email?><br>
                        Telefone:<?=$telefone?><br>
                        CPF:<?=$cpf?><br>
                        Endereço: <?=$rua." Nº: ". $numero?><br>
                        Bairro:<?=$bairro?><br>
                        CEP: <?=$cep?><br>
                        Cidade: <?=$cidade." UF: ". $estado?></p>
                </div>

                <div class="col-md-6 col-lg-6 col-sm-5 col-xs-5 text-right" data-mh="col-md-6">

                    <h6>Data: <b><?=$data?></b></h6>              
                    <h6>Status: <b><?=$status?></b></h6>              

                </div>

            </div>
<hr>
            <div class="row">
                <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">

                    
                    <strong>Descrição:</strong>
                    <p><?=$descricao?></p>
                   
                   
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
                        <?php
                         $produto = "SELECT pos.quantidade,pos.valor as posval,p.id,pos.id as posid, pos.id_ordem, p.valor, p.nome, pos.id_produto FROM produto_os pos INNER JOIN produto p ON ( p.id = pos.id_produto ) WHERE pos.id_ordem = ? ORDER BY p.nome";
		      $consulta = $pdo->prepare($produto);
                $consulta->bindParam(1, $id);
                $consulta->execute();
               
                 while ($dados = $consulta->fetch(PDO::FETCH_OBJ)) {
                $id_produto = $dados->id;
                $quantidade = $dados->quantidade;
                $nome = $dados->nome;
                $valor = $dados->valor;
                $ordem = $dados->id_ordem;
                $posid = $dados->posid;
                



                $v = $valor * $quantidade;
                $totalprodutos += $v;


                $v = number_format($v, 2, ",", ".");
                $valor = number_format($valor, 2, ",", ".");
                
                $v= "R$" . $v;
                
                  echo "
				<tbody>
                <tr>
					<th scope ='row'>$id_produto</th>
                    <td>$quantidade</td>
					<td>$nome</td>  
                    <td>$valor</td>    
                    <td>$v</td>			                          
				</tr>                                
				";
                 }
                 
                 
                
                ?>
                        
                            
                            
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
                <?php
                   

                        
                $servicos = "select s.id, sos.id_ordem,sos.valor as sosval,sos.id as sosid,s.nome,s.descricao FROM servico_os sos INNER JOIN servico s ON ( s.id = sos.id_servico ) WHERE sos.id_ordem = ? ORDER BY s.nome";

                $consultas = $pdo->prepare($servicos);
                $consultas->bindParam(1, $id);
                $consultas->execute();
                
                $totalservicos = 0;
              

                while ($dados = $consultas->fetch(PDO::FETCH_OBJ)) {

                    $id_servico = $dados->id;
                    $nome = $dados->nome;
                    $descricao = $dados->descricao;
                    $sosid = $dados->sosid;
                    $valor = $dados->sosval;

                    $ordem = $dados->id_ordem;
                    
                    
                    
                    $totalservicos = $totalservicos + $valor;
                   
                    
                   
                   
                    
                     $valor = number_format($valor, 2, ",", ".");   
                    echo "
				<tr>                                
                    <th scope='row'>$id_servico</th>                                      
					<td>$nome</td>
                    <td>$descricao</td>
                    <td>R$ $valor</td>     
				</tr>
				";
                }


                    $total = $totalprodutos + $totalservicos;
                   
                    $total = number_format($total, 2, ",", ".");
                        ?>
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
          <?php 

          echo "
          <a href='javascript:faturar($id)'class='btn btn-primary pull-right'>Faturar <i class='glyphicon glyphicon-usd'></i>
        </a>"
                                                    ?>
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