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
				<h4 class="text-center panel-edt3"><i class="glyphicon glyphicon-ok-sign"></i> LISTA DE USUÀRIOS</h4>
			</div>

			<div class="panel-body">
				<a href="cadastroUsuario.php" title="Cadastro de Usuario" class="btn btn-success pull-right">
					<i class="glyphicon glyphicon-file"></i> Novo Cadastro
				</a>
				<br><br>
				<div class="clearfix"></div>

				<?php
						//iniciar a variavel

						//fazer o sql
				$sql = "select * from usuario order by nome";

				$consulta = $pdo->prepare( $sql );
				$consulta->execute();

				?>
				<table class="tabela display nowrap" style="width:100%">
						<thead>
							<tr>
								<td width="1%">ID</td>
								<td data-priority="1">Nome</td>
								<td>CPF</td>								
								<td data-priority="2">Telefone</td>
								<td>Permissão</td>
								<td>Login</td>
								<td>Email</td>
								<td>Ativo</td>								
								<td width="10%">Opções</td>
							</tr>
						</thead>
						<?php
						while ( $dados = $consulta->fetch( PDO::FETCH_OBJ ) ) {

							$id = $dados->id;
							$nome = $dados->nome;
							$cpfcnpj = $dados->cpfcnpj;
							$telefone = $dados->telefone;
							$permissao = $dados->permissao;
							$login = $dados->login;
							$email = $dados->email;
							$ativo = $dados->ativo;


							echo "<tr>
							<td>$id</td>
							<td>$nome</td>
							<td>$cpfcnpj</td>
							<td>$telefone</td>
							<td>$permissao</td>
							<td>$login</td>
							<td>$email</td>
							<td>$ativo</td>			
							<td>
							<a href='cadastroUsuario.php?id=$id'
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
				location.href = "excluirUsuario.php?id="+id;
			}
		}
		$(document).ready(function() {
            $('.tabela').DataTable( {
            	"order": [[ 0, "desc" ]],
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









