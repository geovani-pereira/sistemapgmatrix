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

	//vereficar se existe um marca com esta categoria
	$sql = "select * from servico_os where id_servico = ? limit 1";

	$consulta = $pdo->prepare($sql);
	$consulta->bindParam(1, $id);
	$consulta->execute();

	$dados = $consulta->fetch(PDO::FETCH_OBJ);

	//vereicar se trouxe o registros
	if ( empty( $dados->id_servico ) ) {
		//excluir
		$sql = "delete from servico where id = ? limit 1";
		$consulta = $pdo->prepare($sql);
		$consulta->bindParam(1, $id);
		//vereficar se excutou corretamente
		if ( $consulta->execute() ) {
			//enviar para a listagem
			echo "<script>location.href='listarServico.php';</script>";
		} else {
			//deu erro avisar
			echo"<script>alert('Erro ao excluir registro!';history.back();)</script>";
		}

	} else {
		//mensagem de erro
		echo "<script>alert('Não é possivel excluir,existe ordem de serviço cadastrada com esse serviço');history.back();</script>";
	}
