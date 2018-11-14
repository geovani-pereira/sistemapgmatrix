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
            
            exit;
        }

	$id = "";
	//recuperar o id enviado por GET
	if ( isset ( $_GET["id"] ) ) {
		$id = trim ( $_GET["id"] );
	}
        
	//vereficar se existe um produto com esta categoria
	$sql = "select * from produto_os where id_produto = ? limit 1";

	$consulta = $pdo->prepare($sql);
	$consulta->bindParam(1, $id);
	$consulta->execute();

	$dados = $consulta->fetch(PDO::FETCH_OBJ);

	//vereicar se trouxe o registros
	if ( empty( $dados->id_produto ) ) {
		//excluir
		$sql = "delete from produto where id = ? limit 1";
		$consulta = $pdo->prepare($sql);
		$consulta->bindParam(1, $id);
		//vereficar se excutou corretamente
		if ( $consulta->execute() ) {
			//enviar para a listagem
			echo "<script>location.href='listarProduto.php';</script>";
		} else {
			//deu erro avisar
			echo"<script>alert('Erro ao excluir registro!';history.back();)</script>";
		}

	} else {
		//mensagem de erro
		echo "<script>alert('Não é possivel excluir o produto, produto inserido em ordem de serviço.');history.back();</script>";
	}
