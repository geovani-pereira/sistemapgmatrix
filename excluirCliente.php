<?php 
	session_start();
		
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

	
	$sql = "select * from ordem where id_cliente = ? limit 1";

	$consulta = $pdo->prepare($sql);
	$consulta->bindParam(1, $id);
	$consulta->execute();

	$dados = $consulta->fetch(PDO::FETCH_OBJ);

	//vereicar se trouxe o registros
	if ( empty( $dados->id ) ) {
		//excluir
		$sql = "delete from cliente where id = ? limit 1";
		$consulta = $pdo->prepare($sql);
		$consulta->bindParam(1, $id);
		//vereficar se excutou corretamente
		if ( $consulta->execute() ) {
			//enviar para a listagem
			echo "<script>location.href='listarCliente.php';</script>";
		} else {
			//deu erro avisar
			echo"<script>alert('Erro ao excluir registro!';history.back();)</script>";
		}

	} else {
		//mensagem de erro
		echo "<script>alert('Não é possivel excluir o cliente desejado, pois ele esta cadastrado em alguma ordem de serviço');history.back();</script>";
	}
