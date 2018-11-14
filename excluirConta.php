<?php	session_start();
		
		$permissao = $_SESSION["usuario"]["permissao"];
		if( $permissao == 'admin'){
			include "menu.php";
			
		}else{
			include "menufunc.php";
		}

	$id = "";
	//recuperar o id enviado por GET
	if ( isset ( $_GET["id"] ) ) {
		$id = trim ( $_GET["id"] );

		
	}


	//vereicar se trouxe o registros
	if ( empty( $dados->id ) ) {
		//excluir
		$sql = "delete from conta where id = ? limit 1";
		$consulta = $pdo->prepare($sql);
		$consulta->bindParam(1, $id);
		//vereficar se excutou corretamente
		if ( $consulta->execute() ) {
			//enviar para a listagem
			echo "<script>location.href='listarConta.php';</script>";
		} else {
			exit;
			//deu erro avisar
			echo"<script>alert('Erro ao excluir registro!';history.back();)</script>";
		}

	} else {
		//mensagem de erro
		echo "<script>alert('Não é possivel excluir');history.back();</script>";
	}
