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
				  	<h4 class="text-center panel-edt3"><i class="glyphicon glyphicon-ok-sign"></i> LISTA FINANCEIRO</h4>
				</div>

				<div class="panel-body">
					<a href="financeiro.php" title="Cadastro de Financas" class="btn btn-success pull-right">
						<i class="glyphicon glyphicon-file"></i> Novo Cadastro
					</a>
					<br><br>
					<a href="relatorioFinanceiro.php" title="Relatorio" class="btn btn-success pull-right">
						<i class="glyphicon glyphicon-blackboard"></i> Relatorio
					</a>
					<br><br>
					<div class="clearfix"></div>

					<?php
						//iniciar a variavel

						//fazer o sql
						$sql = "select f.*,date_format(f.data,'%d/%m/%Y') as datas, c.nome from financeiro f inner join cliente c on (c.id = f.id_cliente)";

						$consulta = $pdo->prepare( $sql );
						$consulta->execute();
                                                    
					?>
					<div class="table-responsive">
						<table class="table table-bordered table-striped table-hover">
							<thead>
								<tr>
									<td width="1%">ID</td>
									<td width="15%">Cliente</td>
									<td width="15%">Ordem de Serviço</td>
									<td width="26%">Descrição</td>
									<td width="10%">Valor</td>
									<td width="10%">Data</td>
									<td width="10%">Tipo</td>
									<td width="8%">Opções</td>
								</tr>
							</thead>
							<?php
								while ( $dados = $consulta->fetch( PDO::FETCH_OBJ ) ) {

									$id = $dados->id;
									$id_cliente = $dados->id_cliente;
									$id_ordem = $dados->id_ordem;
									$descricao = $dados->descricao;
									$valor = $dados->valor;
									$data = $dados->datas;
									$tipo = $dados->tipo;

									
									$valor = number_format( $valor, 2, "," , ".");
                                                                        
                                                                        if ($id_cliente == 0)$id_cliente = "Outro";
                                                                        if($id_ordem == 0)$id_ordem = "Outro";

									echo "	<tr>
												<td>$id</td>
												<td>$id_cliente</td>
												<td>$id_ordem</td>
												<td>$descricao</td>
												<td>R$ $valor</td>
												<td>$data</td>
												<td>$tipo</td>
												<td>
													<a href='financeiro.php?id=$id'
													class='btn btn-warning'>
														<i class='glyphicon glyphicon-pencil'></i>
													</a>

													<a href='javascript:deletar($id)' 
													class='btn btn-danger'>
														<i class='glyphicon glyphicon-trash'></i>
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
		//funcao para perguntar se quer deletar
		function deletar(id) {
			if ( confirm("Deseja mesmo excluir?") ) {
				//enviar o id para uma página
				location.href = "excluirFinanceiro.php?id="+id;
			}
		}

		$(document).ready( function(){
			//aplicar a dataTable na tabel
			$(".table").dataTable({
				"language": {
					"lengthMenu": "Mostrando _MENU_ registros por página",
					"zeroRecords": "Nenhum dado encontrado.",
					"info": "Mostrando _PAGE_ de _PAGES_",
					"infoEmpty": "Nenhum dado",
					"infoFiltered": "(filtrado de _MAX_ total)",
					"search": "Busca: ",
					"paginate": {
						"previous": "Anterior",
						"next": "Próxima"
					}
				}
			});
		} ) 
	</script>
</body>
</html>









