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

        if (isset($_GET["os"])) {
                    $id_ordem = trim($_GET["os"]);
                    //trim tira o espaço em branco
                }
?>
	<div id="wrapper">
		<div class="container-fluid">
			<div class="panel panel-edt">
				<div class="panel-heading panel-edt2">
				  	<h4 class="text-center panel-edt3"><i class="glyphicon glyphicon-ok-sign"></i>PARCELAS ORDEM Nº:<?=$id_ordem?></h4>
				</div>

				<div class="panel-body">
					<a href="listarOs.php" title="Cadastro de Usuario" class="btn btn-default pull-right">
						<i class="glyphicon glyphicon-file"></i> Listar Ordens
					</a>
					<br><br>
					<div class="clearfix"></div>
					<?php

					


					

                $sql = "select * from parcela where id_ordem = ?";

						$consulta = $pdo->prepare( $sql );
						$consulta->bindParam(1,$id_ordem);
						$consulta->execute();
                
					
						//iniciar a variavel

						//fazer o sql
						

						

						

					?>
					 <table class="tabela display nowrap" style="width:100%">
							<thead>
								<tr>
									<td width="1%">Parcela</td>									
									<td data-priority="1">Data de Vencimento</td>							
									<td data-priority="2">Data de Pagamento</td>
									<td>Valor</td>																
									<td width="15%">Opções</td>
								</tr>
							</thead>
							<?php

							$i = 0;
								
                	while ($dados = $consulta->fetch(PDO::FETCH_OBJ)) {

              		    $id        = $dados->id;
						$valor     = $dados->valor;
						//$data_vcto = $dados->datavcto;
						$data_pgto = $dados->datapgto;
						$data_vcto = dataformatar($dados->datavcto);
						$valor = number_format( $valor, 2, "," , ".");

						$i++;
						if(empty($data_pgto)){
							$data_pgto = "A Receber";
						}else{
							$data_pgto = dataformatar($data_pgto);
						}

						
						
            			



									echo "<tr>
												<td>$i º</td>											
												<td>$data_vcto</td>
												<td>$data_pgto</td>
												<td>R$$valor</td>
												
												<td>
													<a href='javascript:pagar($id)'
													class='btn btn-primary'>
														<p>Receber</p>
													</a>


													<a href='editarParcela.php?id=$id'
													class='btn btn-warning'>
														<p>Editar Data</p>
													</a>
												</td>
											</tr>";
								}
							?>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript">
			
		//funcão para alterar data de pagamento da parcela
		function pagar(id) {
			if ( confirm("Deseja mesmo alterar o status desta parcela para Pago ?") ) {
				//enviar o id para uma página
				location.href = "pagarParcela.php?id="+id;
			}
		}

		$(document).ready(function() {
            $('.tabela').DataTable( {
            	"order": [[ 0, "asc" ]],
                responsive: true,
                "info":     false,
                columnDefs: [
                { responsivePriority: 1, targets: 0 },
                { responsivePriority: 2, targets: -2 }
                ],
                "language": {
                    "lengthMenu": "Mostrando _MENU_ registros por página",
                    "zeroRecords": "Ordem de serviço sem faturar.",
                    "info": "Mostrando _PAGE_ de _PAGES_",
                    "infoEmpty": "Nenhum dado",
                    "infoFiltered": "(filtrado de _MAX_ total)",
                    "search": "Busca: ",  
                    "paginate": {
                        "previous": "Anterior",
                        "next": "Próxima",
                    }
                }
            } );
        } );
	</script>
</body>
</html>









