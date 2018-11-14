<?php 
	session_start();
		
		$permissao = $_SESSION["usuario"]["permissao"];
		if( $permissao == 'admin'){
			include "menu.php";
			
		}else{
			include "menufunc.php";
		};
        

    
    
         if ($permissao == "funcionario"){
            echo "<script>alert('Você não tem acesso a este nivel do sistema, entre em contato com o administrador');history.back();</script>";
            
            
        }
	// iniciando variaveis 
	$id = $nome = $id_ordem = $valor = $datavcto = $datapgto = "";
	$total = 0;

	if ( $_GET ) {
		$id_ordem = trim( $_GET["os"] );

		$sql = "select c.nome as nomecli from ordem os inner join cliente c on (c.id = os.id_cliente) where os.id = ? limit 1";

		//"SELECT * FROM produto WHERE id = ? LIMIT 1";
		$consulta = $pdo->prepare($sql);
		$consulta->bindParam(1, $id_ordem);
		$consulta->execute();
		$dados = $consulta->fetch(PDO::FETCH_OBJ);

		//variavel recebe ->dados do objeto.
		
		$nome = $dados->nomecli;
		
		$datavcto = date('d/m/Y');

		

        
    

   
		/*
		$sql = "select parc.*,os.id,os.id_cliente,os.descricao,c.nome as nomecli from parcela parc inner join ordem os inner join cliente c on (c.id  = os.id_cliente) where parc.id_ordem = ? limit 1";
		$consulta = $pdo->prepare($sql);
		$consulta->bindParam(1, $id_ordem);
		$consulta->execute();
		$dados = $consulta->fetch(PDO::FETCH_OBJ);

		$id = $dados->id;
		$nome = $dados->nomecli;
		$id_ordem = $dados->id_ordem;
		$valor = $dados->valor;
		$descricao = $dados->descricao;
		$datavcto = $dados->datavcto;
		$datapgto = $dados->datapgto;
                
         $datavcto = dataformatar($datavcto);
		*/
        
                
		

		// PRODUTOS //////////////
		$totalprodutos = 0;
		$produto = "SELECT pos.quantidade,pos.valor as posval,p.id,pos.id as posid, pos.id_ordem, p.valor, p.nome, pos.id_produto FROM produto_os pos INNER JOIN produto p ON ( p.id = pos.id_produto ) WHERE pos.id_ordem = ? ORDER BY p.nome";
		$consulta2 = $pdo->prepare($produto);
                $consulta2->bindParam(1, $id_ordem);
                $consulta2->execute();
                
                 while ($dados = $consulta2->fetch(PDO::FETCH_OBJ)) {
               
                $quantidade = $dados->quantidade;
               
                $valor = $dados->valor;
               
                


                $v = $valor * $quantidade;
                $totalprodutos += $v;
                $v = number_format($v, 2, ",", ".");
                $valor = number_format($valor, 2, ",", ".");
            }
                /// Serviços ////

                 $servicos = "SELECT s.id, sos.id_ordem,sos.valor as sosval,sos.id as sosid,s.nome,s.descricao FROM servico_os sos INNER JOIN servico s ON ( s.id = sos.id_servico ) WHERE sos.id_ordem = ? ORDER BY s.nome";

                $consulta3 = $pdo->prepare($servicos);
                $consulta3->bindParam(1, $id_ordem);
                $consulta3->execute();
                
                $totalservicos = 0;
                $totalservicos = 0;

                while ($dados = $consulta3->fetch(PDO::FETCH_OBJ)) {

                  
                    
                    $descricao = $dados->descricao;
                    
                    $valor = $dados->sosval;

                    $ordem = $dados->id_ordem;

                     $totalservicos = $totalservicos + $valor;
					}		
                   /// total ///// 

                     $total = $totalprodutos + $totalservicos;
                   
                    


  
	}
	$parcelas = "select * from parcela where id_ordem = ?";

                $consulta4 = $pdo->prepare($parcelas);
                $consulta4->bindParam(1, $id_ordem);
                $consulta4->execute();

		$qtd_parcela = $consulta4->rowCount();

	
	$total = number_format($total, 2, ",", ".");
?>


<div id="wrapper">
	<div class="container-fluid">
		<div class="panel panel-edt">
		  		<div class="panel-heading panel-edt2">
		  		<h4 class="text-center panel-edt3">
			  		<i class="glyphicon glyphicon-usd"></i> PAGAMENTO</h4>
		  		</div>
		  	

			<div class="panel-body">
			   	
				<br>
				<div class="clearfix"></div>
					
					<form name="form1" method="post" action="salvarPagamento.php" enctype="multipart/form-data" novalidate>
						<fieldset style="margin-bottom:5px;">
							<div class="col-md-1">
								<div class="control-group">
									<label for="id_ordem">OS Nº: </label>
									<div class="controls">
                                                                            <input type="text" readonly name="id_ordem" class="form-control" value="<?=$id_ordem;?>">
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="control-group">
									<label for="id_cliente">Cliente: </label>
									<div class="controls">
										<input type="text" readonly name="id_cliente" class="form-control" value="<?=$nome;?>">
									</div>
								</div>
							</div>
							
							 <div class="col-md-2">
								<div class="control-group">
									<label for="total">Valor Total:</label>
									<div class="controls">
										<input type="text" readonly name="total" class="form-control" id="total" value="<?=$total;?>"></input>
									</div>
								</div>
							</div>
							<div class="col-md-3">
                                <div class="control-group">
                                        <label class="control-label">Forma Pagamento:</label>
                                    <div class="controls">
                                        <select name="n-parcelas" id="n-parcelas" required data-validation-required-message="Selecione uma forma de Pagamento" class="form-control">                                                                                    
                                            <option value="1">Dinheiro</option>
                                            <option value="1">Cartão em até 12x</option>
                                            <option value="2">Parcelado em 2x</option>
                                            <option value="3">Parcelado em 3x</option>
                                            <option value="4">Parcelado em 4x</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            
							<div class="col-md-2">
								<div class="control-group">
									<label for="valor_parcela">* Valor da Parcela: </label>
									<div class="controls">
									<input type="text" readonly name="valor_parcela" class="form-control" id="valor_parcela" value="<?=$total;?>">
									
									</div>
								</div>
							</div>
						
							<div class="col-md-2">
                                        <div class="control-group">
                                            <label for="datavcto" class="control-label">
                                                Data Vencimento:</label>
                                            <div class="input-group date">
                                                <input type="text" 
                                                       name="datavcto" id="datetimepicker1"
                                                       class="form-control"
                                                       required
                                                       data-validation-required-message="Preencha o vencimento"
                                                       value="<?= $datavcto; ?>" >
                                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="control-group">
                                            <label for="datavcto2" class="control-label">
                                                2º Parcela:</label>
                                            <div class="input-group date">
                                                <input type="text" 
                                                       name="datavcto2" id="datetimepicker2"
                                                       class="form-control"
                                                       value="" >
                                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="control-group">
                                            <label for="datavcto3" class="control-label">
                                                3º Parcela:</label>
                                            <div class="input-group date">
                                                <input type="text" 
                                                       name="datavcto3" id="datetimepicker3"
                                                       class="form-control"
                                                       value="" >
                                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="control-group">
                                            <label for="datavcto4" class="control-label">
                                                4º Parcela:</label>
                                            <div class="input-group date">
                                                <input type="text" 
                                                       name="datavcto4" id="datetimepicker4"
                                                       class="form-control"
                                                       value="" >
                                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="listarParcela">
					<a href="listarParcela.php?os=<?=$id_ordem?>" class="btn btn-default">
					<i class="glyphicon glyphicon-search"></i>Visualizar Parcelas
					</a>

				</div>	      
							<script>
								$('.input-group.date').datepicker({
								format: 'dd/mm/yyyy',
								language: 'pt-BR',
								weekStart: 0,
								startDate:'0d',
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
							<br>
						</fieldset>
						<button type="submit" class="btn center-block btn-success btn-lg">Faturar</button>
					</form>
				</div>
			</div>
		</div>
	</div>


<script>

            

	//Configuração DatePicker
	$('.input-group.date').datepicker({
	format: 'dd/mm/yyyy',
	language: 'pt-BR',
	weekStart: 0,
	startDate:'0d',
	autoclose: true
	});

	$("#n-parcelas").val("<?= $qtd_parcela; ?>"); // jogar quantidade de parcelas dentro do value



	function moedaParaNumero(valor) //função numero para valor
{
    return isNaN(valor) == false ? parseFloat(valor) :   parseFloat(valor.replace("R$","").replace(".","").replace(",","."));
}
	$(document).ready(function(){
	
		var valor = (document.getElementById('total').value);
		var parcela = (document.getElementById('n-parcelas').value)
		valor = moedaParaNumero(valor);
			


		if (parcela < 2 ){
			//console.log(parcela)
			$('.listarParcela').css('display', 'none');
		}
		

		for(i =2; i<= 4; i++){
			$('#datetimepicker'+i).parents('.col-md-2').css('display', 'none');
		}
	});

	$('#n-parcelas').change(function(){
		var datepicker = [];
		var data = [];
		var valor        = moedaParaNumero($("input[name=total").val());
		var parcela      = parseInt(($(this).val()));
		var totalParcela = "";
		for(i =2; i<= 4; i++){
			$('#datetimepicker'+i).parents('.col-md-2').css('display', 'none').val('');

		}
		for( i=1; i<=parcela; i++){
			datepicker.push(i);	
		$('#datetimepicker'+datepicker[0]).parents('.col-md-2').css('display', 'block');
		$('#datetimepicker'+datepicker[1]).parents('.col-md-2').css('display', 'block');
		$('#datetimepicker'+datepicker[2]).parents('.col-md-2').css('display', 'block');
		$('#datetimepicker'+datepicker[3]).parents('.col-md-2').css('display', 'block');
		}

		if(parcela == 0){
			parcela = 1;
		} 
		
		
		totalParcela = valor / parcela;
		item2 = parseFloat(totalParcela);
		console.log(totalParcela);
	
		var definitivo = (totalParcela);

		function numeroParaMoeda(n, c, d, t)
                {
                    c = isNaN(c = Math.abs(c)) ? 2 : c, d = d == undefined ? "," : d, t = t == undefined ? "." : t, s = n < 0 ? "-" : "", i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "", j = (j = i.length) > 3 ? j % 3 : 0;
                    return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
                }

               item2 = numeroParaMoeda(item2);

        $('#valor_post').val(totalParcela);
	
		$('#valor_parcela').val(item2);

		
		function dataAtualFormatada(now){
		    var dia = now.getDate();
		    if (dia.toString().length == 1)
		      dia = "0"+dia;
		    var mes = now.getMonth()+1;
		    if (mes.toString().length == 1)
		      mes = "0"+mes;
		    var ano = now.getFullYear();  
		    return dia+"/"+mes+"/"+ano;
		}


		for(var i = 0; i < parcela; i++){
			var now = new Date();
			var month = now.getMonth();
			now.setMonth(month + i);
			data1 = dataAtualFormatada(now);
			data.push(data1);					
		}


		$('#datetimepicker1').val(data[0]);
		$('#datetimepicker2').val(data[1]);
		$('#datetimepicker3').val(data[2]);
		$('#datetimepicker4').val(data[3]);

	});
</script>