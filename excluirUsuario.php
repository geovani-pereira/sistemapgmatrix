<?php 
	session_start();
		
		$permissao = $_SESSION["usuario"]["permissao"];
		if( $permissao == 'admin'){
			include "menu.php";
			
		}else{
			"<script>alert('Você não tem permissao para exluir um usuário!');history.back();</script>";
				header("Location: home.php");
		};
		

	$id = "";
	//recuperar o id enviado por GET
	if ( isset ( $_GET["id"] ) ) {
		$id = trim ( $_GET["id"] );
	}

	//vereficar se existe um marca com esta categoria
	$sql = "select * from ordem where id_usuario = ? limit 1";

	$consulta = $pdo->prepare($sql);
	$consulta->bindParam(1, $id);
	$consulta->execute();

	$dados = $consulta->fetch(PDO::FETCH_OBJ);

	//vereicar se trouxe o registros
	if ( empty( $dados->id_cliente ) ) {
		//excluir
		$sql = "delete from usuario where id = ? limit 1";
		$consulta = $pdo->prepare($sql);
		$consulta->bindParam(1, $id);
		//vereficar se excutou corretamente
		if ( $consulta->execute() ) {
			//enviar para a listagem
			echo "<script>location.href='listarUsuario.php';</script>";
		} else {
			//deu erro avisar
			echo"<script>alert('Erro ao excluir registro!';history.back();)</script>";
		}

	} else {
		//mensagem de erro
		echo "<script>alert('Não é possivel excluir,existe ordem de serviço cadastrada por esse usuário');history.back();</script>";
	}
