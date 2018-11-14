<?php

			session_start();
		
		$permissao = $_SESSION["usuario"]["permissao"];
		if( $permissao == 'admin'){
			include "menu.php";
			
		}else{
			include "menufunc.php";
		};
		

    
        
        
	if ( $_POST ) {

		//recuperar os dados do formulário
		//print_r( $_POST );
		$id = trim( $_POST["id"] );
		$nome = trim( $_POST["nome"]);
		$cpfcnpj = trim( $_POST["cpfcnpj"]);
		$permissao2 = trim( $_POST["permissao"]);
		$ativo = trim( $_POST["ativo"]);
		$login = trim( $_POST["login"]);
        $email = trim( $_POST["email"]);                
		$telefone = trim( $_POST["telefone"]);
		$senha = trim( $_POST["senha"]);



		

		
		

		//verificar se o campo esta em branco
		if ( empty( $nome ) ) {
			echo "<script>alert('Preencha a nome');history.back();</script>";
		} else if ( empty( $cpfcnpj ) ) {
			echo "<script>alert('Preencha o CPF');history.back();</script>";
		} else if ( empty( $permissao) ) {
			echo "<script>alert('Selecione o nivel de permissão');history.back();</script>";
		} else if ( empty( $ativo ) ) {
			echo "<script>alert('Selecione se o usuario esta ativo ou não');history.back();</script>";
		} else if ( empty( $login ) ) {
			echo "<script>alert('Preencha o login');history.back();</script>";
		} else if ( empty( $email ) ) {
			echo "<script>alert('Preencha o email');history.back();</script>";
		}else if ( empty( $senha ) ) {
			echo "<script>alert('Preencha a senha');history.back();</script>";
		}else if ( empty( $telefone ) ) {
			echo "<script>alert('Preencha o telefone');history.back();</script>";
		} else {

			

			//verificar se o registro já existe
			$sql = "select * from usuario
			where cpfcnpj = ? and id <> ? limit 1";
			$consulta = $pdo->prepare($sql);
			$consulta->bindParam(1, $cpfcnpj);
			$consulta->bindParam(2, $id);
			$consulta->execute();
			$dados = $consulta->fetch(PDO::FETCH_OBJ);


			if ( ! empty ( $senha ) ) $senha = md5( $senha );

			if ( !empty( $dados->cpfcnpj) ) {
				//já existe um registro cadastrado
				echo "<script>alert('Já existe um usuario com este CPF');history.back();</script>";
				exit;

			}
			

			$sql2 = "select * from usuario where login = ? and id <> ? limit 1";
			$consulta = $pdo->prepare($sql2);
			$consulta->bindParam(1, $login);
			$consulta->bindParam(2, $id);
			$consulta->execute();
			$dados = $consulta->fetch(PDO::FETCH_OBJ);


			if( !empty($dados->login)){
				echo "<script>alert('Já existe um usuario com este Login');history.back();</script>";
				exit;

			}

			//verificar se o id esta vazio - insert
			if ( empty ( $id ) ) {
				//gravar no banco de dados
				$sql = "insert into usuario (id, nome, cpfcnpj, permissao, ativo, login, email, senha, telefone) values (NULL, ?, ?, ?, ?, ?, ?, ?, ?)";
				$consulta = $pdo->prepare($sql);
				//passar o parametro
				$consulta->bindParam(1, $nome);
				$consulta->bindParam(2, $cpfcnpj);
				$consulta->bindParam(3, $permissao2);
				$consulta->bindParam(4, $ativo);
				$consulta->bindParam(5, $login);                                
                $consulta->bindParam(6, $email);
				$consulta->bindParam(7, $senha);
				$consulta->bindParam(8, $telefone);
				
				




			} else if($permissao == "admin") {
				//dar update

				
				$sql = "update usuario set nome = ?, cpfcnpj = ?, permissao = ?, ativo = ?, login = ?, email = ?, senha = ?, telefone = ? where id = ? limit 1";
				$consulta = $pdo->prepare($sql);

				$consulta->bindParam(1, $nome);
				$consulta->bindParam(2, $cpfcnpj);
				$consulta->bindParam(3, $permissao2);
				$consulta->bindParam(4, $ativo);
				$consulta->bindParam(5, $login);
                $consulta->bindParam(6, $email);
				$consulta->bindParam(7, $senha);
				$consulta->bindParam(8, $telefone);
				$consulta->bindParam(9, $id);
				
			}else{
				$sql = "update usuario set senha = ?, telefone = ?, permissao = ? where id = ? limit 1";
				$consulta = $pdo->prepare($sql);
				$consulta->bindParam(1, $senha);
				$consulta->bindParam(2,	$telefone);
				$consulta->bindParam(3, $permissao2);
				$consulta->bindParam(4, $id);
			}

			//verificar se executou corretamente
			if ( $consulta->execute() ) {

				echo "<script>alert('Registro Salvo');location.href='listarUsuario.php';</script>";

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