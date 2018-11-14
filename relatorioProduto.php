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
<div id="wrapper">
	<div class="container-fluid">
		<div class="panel panel-edt">
		  		<div class="panel-heading panel-edt2">
		  		<h4 class="text-center panel-edt3">
			  		<i class="fa fa-pie-chart fa-1x"></i> RELATÓRIO PRODUTO</h4>
		  		</div>
		  	

			<div class="panel-body">
				<div class="clearfix"></div>

					<form name="form1" method="get" action="listaRelatorioProduto.php" enctype="multipart/form-data" novalidate>
						<fieldset>
							<div class="col-md-2">
								<div class="control-group">
									<label for="tipo">Filtro:</label>
									<div class="controls">
										<select	name="tipo" id="tipo" class="form-control" required
										data-validation-required-message="Selecione o tipo de Filtro" onchange="exibir_ocultar(this)">
											<option value="mv">Mais Vendidos</option>
											<option value="tp">Todos os Produtos</option>
											<option value="em">Estoque Minimo "1"</option>
											<option value="fe">Fora de Estoque "0"</option>
										</select>
									</div>
									<script type="text/javascript">
										$("#tipo").val("<?=$tipo;?>");
									</script>
								</div>
							</div>
							<div id="mostrarNome">
								<div class="col-md-2">
									<div class="control-group">
										<label for="tipo" title="Filtrar por *MARCA é opcional">
											<i class="fa fa-info-circle">
											</i> Por Marca:
										</label>
										<select name="id_marca" class="form-control">
											<option value="">Todos as Marcas</option>
											<?php
											//selecionar as categorias
											$sql = "select * from marca order by marca";
											//preparar o sql e execultar
											$consulta = $pdo->prepare($sql);
											$consulta->execute();

											while ($dados = $consulta->fetch(PDO::FETCH_OBJ)) {

												$id = $dados->id;
												$marca = $dados->marca;

												echo "<option value='$marca'>$marca</option>";
											}
											?>
										</select>
									</div>
								</div>
							</div>
							<div id="mostrarData1"> 
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
	                            </div>
	                            <div id="mostrarData2">
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
	                            </div>
							<br>
						</fieldset>
						<button type="submit" class="btn center-block btn-success btn-lg">Filtrar</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" src="js/jquery.easy-autocomplete.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/easy-autocomplete.min.css">

<script type="text/javascript">

    $('.input-group.date').datepicker({
    format: 'dd/mm/yyyy',
    language: 'pt-BR',
    weekStart: 0,
    autoclose: true
    });

function exibir_ocultar(val) {
  if(val.value == 'tp') {
    document.getElementById('mostrarData1').style.display = 'none';
    document.getElementById('mostrarData2').style.display = 'none';
    document.getElementById('mostrarNome').style.display = 'block';
    //none esconde e o block mostra
  }
  else if(val.value == 'mv') {
    document.getElementById('mostrarData1').style.display = 'block';
    document.getElementById('mostrarData2').style.display = 'block';
    document.getElementById('mostrarNome').style.display = 'block';
  } else {
  	document.getElementById('mostrarData1').style.display = 'none';
    document.getElementById('mostrarData2').style.display = 'none';
    document.getElementById('mostrarNome').style.display = 'block';
  }
};
</script>
</body>
</html>


