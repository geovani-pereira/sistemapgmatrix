<?php

		session_start();
		
		$permissao = $_SESSION["usuario"]["permissao"];
		if( $permissao == 'admin'){
			include "menu.php";
		}else{
			include "menufunc.php";
		}

	if ( $_POST ) {

		//recuperar os dados do formulário
		//print_r( $_POST );
		$id = trim( $_POST["id"] );
		$marca = trim( $_POST["marca"] );

		//gravar no manco tudo em maiusculo
		$marca = strtoupper($marca);

		//verificar se o campo esta em branco
		if ( empty( $marca ) ) {
			//mensagem com o javascript
			echo "<script>alert('Preencha a marca');history.back();</script>";
		} else {

			//verificar se o registro já existe
			$sql = "select * from marca
			where marca = ? and id  <> ? limit 1";
			// <> diferente
			$consulta = $pdo->prepare($sql);
			$consulta->bindParam(1, $marca);
			$consulta->bindParam(2, $id);
			$consulta->execute();
			$dados = $consulta->fetch(PDO::FETCH_OBJ);

			if ( !empty( $dados->marca ) ) {
				//já existe um registro cadastrado
				echo "<script>alert('Já existe um cadastro com esta marca');history.back();</script>";
				exit;

			}


			//verificar se o id esta vazio - insert
			if ( empty ( $id ) ) {
				//gravar no banco de dados
				$sql = "insert into marca (id, marca)
				values (NULL, ? )";
				$consulta = $pdo->prepare($sql);
				//passar o parametro
				$consulta->bindParam(1, $marca);
			} else {
				//dar update
				$sql = "update marca 
					set marca = ? 
					where id = ? 
					limit 1";
				$consulta = $pdo->prepare( $sql );
				$consulta->bindParam( 1, $marca );
				$consulta->bindParam( 2, $id );

			}

			//verificar se executou corretamente
			if ( $consulta->execute() ) {

				echo "<script>alert('Registro Salvo');location.href='listarMarca.php';</script>";

			} else {

				echo "<script>alert('Erro ao Salvar');history.back();</script>";

			}
		}
	} else {

		//mensagem de erro ao acessar diretamente o arquivo
		echo "<div class='alert alert-danger container'>
		ERRO: tentativa inválida</div>";

	}

?>

</body>
</html>