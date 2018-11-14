<?php
		session_start();
		
		$permissao = $_SESSION["usuario"]["permissao"];
		if( $permissao == 'admin'){
			include "menu.php";
		}else{
			include "menufunc.php";
		}
?>
	<div id="wrapper">
		<div class="container-fluid">
			<div class="panel panel-edt">
				<div class="panel-heading panel-edt2">
				  	<h4 class="text-center panel-edt3"><i class="glyphicon glyphicon-ok-sign"></i> LISTA DE CLIENTES COM DÈBITO</h4>
				</div>

				<div class="panel-body">
					<a href="cadastroCliente.php" title="Cadastro de CLIENTE" class="btn btn-success pull-right">
						<i class="glyphicon glyphicon-file"></i> Novo Cadastro
					</a>
					<br><br>
					<div class="clearfix"></div>

					<?php
						//iniciar a variavel

						//fazer o sql
						$sql = "select c.nome,p.datapgto,os.id as ordem,p.datavcto as vencimento,p.id as parcela,p.valor as valor from cliente c inner join ordem os on (c.id = os.id_cliente) inner join parcela p on (p.id_ordem = os.id) where p.datapgto is null";

						$consulta = $pdo->prepare( $sql );
						$consulta->execute();

					?>
					<table class="tabela display nowrap" style="width:100%">
							<thead>
								<tr>
									<td width="1%">Parcela</td>
									<td data-priority="1">Nome</td>								
									<td>Ordem</td>
									<td data-priority="2">Valor</td>
									<td>Vencimento</td>                                                      
									<td width="5%">Opções</td>
								</tr>
							</thead>
							<?php
								while ( $dados = $consulta->fetch( PDO::FETCH_OBJ ) ) {

									
									$nome = $dados->nome;
									$ordem = $dados->ordem;
									$parcela = $dados->parcela;
									$vencimento = $dados->vencimento;
									$valor = $dados->valor;
									
                                                                        
                                    $vencimento = dataformatar($vencimento);
                                    $valor = number_format( $valor, 2, "," , ".");                                   

									echo "<tr>
												<td>$parcela</td>
												<td>$nome</td>										
												<td>$ordem</td>	
												<td>R$$valor</td>											
												<td>$vencimento</td>
                                                                                                
												<td>
													<a href='javascript:pagar($parcela)'
													class='btn btn-primary'>
														<p>Receber</p>
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
		//funcao para pagar parcela
	function pagar(id) {
			if ( confirm("Deseja mesmo alterar o status desta parcela para Pago ?") ) {
				//enviar o id para uma página
				location.href = "pagarParcela.php?id="+id;
			}
		}

		$(document).ready(function() {
            $('.tabela').DataTable( {
            	"order": [[ 1, "asc" ]],
                responsive: true,
                "info":     false,
                columnDefs: [
                { responsivePriority: 1, targets: 0 },
                { responsivePriority: 2, targets: -2 }
                ],
                "language": {
                    "lengthMenu": "Mostrando _MENU_ registros por página",
                    "zeroRecords": "Nenhum dado encontrado.",
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









