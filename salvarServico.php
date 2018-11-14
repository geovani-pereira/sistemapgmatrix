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
		$id = trim ( $_POST["id"] );
		$nome = trim ( $_POST["nome"] );
		$descricao = trim ( $_POST["descricao"] );
		$valor = trim($_POST["valor"]);
		//gravar no manco tudo em maiusculo
		
		
		$valor = formatarvalor($valor);

		if ( empty ( $id ) ) { 
			//inserir
			$sql = "insert into servico (nome, descricao, valor)
			values (?, ?, ?)";
			$consulta = $pdo->prepare( $sql );
			$consulta->bindParam( 1, $nome );
			$consulta->bindParam( 2, $descricao);
			$consulta->bindParam( 3, $valor);
		} else {
			//atualizar

			$sql = "update servico set nome = ?, descricao = ?, valor = ? where id = ? limit 1";
			$consulta = $pdo->prepare( $sql );
			$consulta->bindParam( 1, $nome );
			$consulta->bindParam( 2, $descricao);
			$consulta->bindParam( 3, $valor );
			$consulta->bindParam( 4, $id );

		}


		if ( $consulta->execute() ) {
			echo "<script>alert('Registro salvo');location.href='listarServico.php';</script>";
		} else {
			echo "<script>alert('Erro ao salvar');history.back();</script>";
		}
	




