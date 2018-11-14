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
				  	<h4 class="text-center panel-edt3"><i class="glyphicon glyphicon-ok-sign"></i> LISTA DE LOGS</h4>
				</div>

				<div class="panel-body">
					

					<?php
						//iniciar a variavel

						//fazer o sql
						$sql = "select l.*, u.nome from logs l inner join usuario as u on (u.id = l.id_usuario) order by l.id DESC;";

						$consulta = $pdo->prepare( $sql );
						$consulta->execute();

					?>
					
						<table class="tabela display nowrap" style="width:100%">
							<thead>
								<tr>
									<td width="1%">ID</td>
                                    <td data-priority="1">Usuario</td>
									<td>Data/Hora</td>
									<td data-priority="2">Log</td>
								</tr>
							</thead>
							<?php
                                                        
								while ( $dados = $consulta->fetch( PDO::FETCH_OBJ ) ) {

									$id = $dados->id;
                                                                        $usuario = $dados->nome;
									$hora = $dados->hora;
                                                                        $log = $dados->alteracao;
                                                                        
                                                                        
                                                                        $hora = date('d/m/Y H:i:s', strtotime($hora));

									echo "	<tr>
												<td>$id</td>
                                                                                                <td>$usuario</td>
												<td>$hora</td>
                                                                                                <td>$log</td>
												
											</tr>";
								}
							?>
						</table>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		//funcao para perguntar se quer deletar
		

		$(document).ready(function() {
    $('.tabela').DataTable( {
        responsive: true,
        columnDefs: [
            { responsivePriority: 1, targets: 0 },
            { responsivePriority: 2, targets: -2 }
        ], "order": [[ 0, "desc" ]],  

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









