<?php

		session_start();
		
		$permissao = $_SESSION["usuario"]["permissao"];
		if( $permissao == 'admin'){
			include "menu.php";
		}else{
			include "menufunc.php";
		}



	//verificar se foi post

		//salvar no banco de dados
		$id = trim( $_POST["id"] );
		$descricao = trim( $_POST["descricao"] );
		$valor = trim( $_POST["valor"] );
		$data = trim( $_POST["data"] );
		$conta = trim( $_POST["conta"] );
		//gravar no manco tudo em maiusculo
		
		$data = formatardata($data);
		$valor = formatarvalor($valor);

		if ( empty ( $id ) ) { 
			//inserir
			$sql = "insert into conta (id, descricao, valor, data, conta)
			values (NULL, ?, ?, ?, ?)";
			$consulta = $pdo->prepare( $sql );
			$consulta->bindParam( 1, $descricao);
			$consulta->bindParam( 2, $valor);
			$consulta->bindParam( 3, $data );
			$consulta->bindParam( 4, $conta);
		} else {
			//atualizar
			$sql = "update conta set descricao = ?, valor = ?, data = ?, conta = ? where id = ? limit 1";
			$consulta = $pdo->prepare( $sql );
			$consulta->bindParam( 1, $descricao);
			$consulta->bindParam( 2, $valor );
			$consulta->bindParam( 3, $data);
			$consulta->bindParam( 4, $conta);
			$consulta->bindParam( 5, $id );

		}


		if ( $consulta->execute() ) {
			echo "<script>alert('Registro salvo');location.href='listarConta.php';</script>";
		} else {
			echo "<script>alert('Erro ao salvar');history.back();</script>";
		}
	




