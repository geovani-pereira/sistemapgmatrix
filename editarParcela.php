<?php
		session_start();
		
		$permissao = $_SESSION["usuario"]["permissao"];
		if( $permissao == 'admin'){
			include "menu.php";
		}else{
			include "menufunc.php";
		}
	


	//verificar se está editando
	if ( isset ( $_GET["id"] ) ) {

		//recuperar o id por get
		$id = trim( $_GET["id"] );
		//selecionar os dados do banco
		$sql = "select * from parcela where id = ? limit 1";
		//prepare
		$consulta = $pdo->prepare( $sql );
		//passar um parametro
		$consulta->bindParam( 1, $id );
		//executa
		$consulta->execute();


		//separar os dados
		$dados = $consulta->fetch(PDO::FETCH_OBJ);

		$id = $dados->id;
		$id_ordem = $dados->id_ordem;
		$valor = $dados->valor;
		$datavcto = $dados->datavcto;
		$datapgto = $dados->datapgto;

		$datavcto = date('d/m/Y', strtotime($datavcto));

		if(!empty($datapgto)){
		$datapgto = dataformatar($datapgto);
		}else{
			$datapgto = NULL;
		}
		$valor = number_format( $valor, 2, "," , ".");


	}


?>
	<div id="wrapper">
		<div class="container-fluid">
			<div class="panel panel-edt">
						<div class="panel-heading panel-edt2">
			  			<h4 class="text-center panel-edt3">
			  			<i class="glyphicon glyphicon-plus-sign"></i>Editar Parcela</h4>
			  			</div>

				<div class="panel-body">
						
							<div class="clearfix"></div>

						<form name="formparcela" method="post" action="salvarParcela.php" novalidate>
					<fieldset>
							<div class="col-md-1">
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
                                            <label for="datavcto" class="control-label">
                                                Data Vencimento</label>
                                            <div class="input-group date">
                                                <input type="text" 
                                                       name="datavcto" id="datetimepicker1"
                                                       class="form-control"
                                                       required 
                                                       data-validation-required-message="Preencha a Inicial"
                                                       value="<?= $datavcto; ?>">
                                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                            </div>
                                        </div>
                                    </div>


                            <div class="col-md-5">
                                        <div class="control-group">
                                            <label for="datapgto" class="control-label">
                                                Data Pagamento</label>
                                            <div class="input-group date">
                                                <input type="text" 
                                                       name="datapgto" id="datetimepicker1"
                                                       class="form-control"                                                     value="<?= $datapgto; ?>">
                                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                            </div>
                                        </div>
                                    </div>        

							<div class="col-md-2">
						<div class="control-group">
							<label for="valor">Valor: </label>
							<div class="controls">
								<input type="text" name="valor" readonly class="form-control valor" value="<?=$valor;?>">
								
						</div>
					</div>
				</div>
					</fieldset>
						<button type="submit" class="btn center-block btn-lg btn-success">Salvar Dados</button>
						</form>
				</div>	
			</div>
		</div>
	</div>	
				
		
<script>

    $('.input-group.date').datepicker({
    	format: 'dd/mm/yyyy',
    	language: 'pt-BR',
    	autoclose: true,
    	
    	
    });

</script>
