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
		  	<div class="panel-heading panel-edt2"><h4 class="text-center panel-edt3"><i class="glyphicon glyphicon-tag"></i> LISTA DE SERVIÇOS</h4></div>
			  	<div class="panel-body">
			   		

		<a href="cadastroServico.php" title="Cadastro de Serviços" class="btn btn-default pull-right">
			<i class="glyphicon glyphicon-file"></i>
			Novo Serviço
		</a>

		<div class="clearfix"></div>

		
		
		<?php 
			
		

			$sql = "select * from servico";

				
				$consulta = $pdo->prepare( $sql );
				$consulta->execute();



		?>
		<br>
		 <table class="tabela display nowrap" style="width:100%">
			<thead>
				<tr>
					<td width="1%">ID</td>
					<td data-priority="1">Serviço</td>
					<td data-priority="2">Valor</td>				
					<td width="15%">Opções</td>
				</tr>
			</thead>
			<?php 

			while ( $dados = $consulta->fetch ( PDO:: FETCH_OBJ ) ) {

				$id = $dados->id;
				$servico = $dados->nome;
				$valor = $dados->valor;

				$valor = number_format( $valor, 2, "," , ".");
			

				echo "<tr>
						<td>$id</td>
						<td>$servico</td>
						<td>R$$valor</td>
						

						<td>
						<a href='cadastroServico.php?id=$id'
						class='btn btn-warning'>
							<i class='glyphicon glyphicon-pencil'></i>
						</a>

						<a href='javascript:deletar($id)' class='btn btn-danger'>
							<i class='glyphicon glyphicon-trash'></i>
						</a>
					</td>
					  </td>";

			}	
		?>
				</table>
			  	</div>
		</div>

		


	 
	</div>

	<script type="text/javascript">
		//funcao para perguntar se quer deletar
		function deletar(id) {
			if ( confirm("Deseja mesmo excluir?") ) {
				//enviar o id para uma página
				location.href = "excluirServico.php?id="+id;
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
