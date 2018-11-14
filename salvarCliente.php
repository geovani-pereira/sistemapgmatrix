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
		$nome = trim( $_POST["nome"]);
		$nascimento = trim( $_POST["data"] );
		$rg = trim( $_POST["rg"] );
		$cpfcnpj = trim( $_POST["cpfcnpj"] );
		$telefone = trim( $_POST["telefone"] );
		$email = trim( $_POST["email"] );
		$rua = trim( $_POST["rua"] );
		$numero = trim( $_POST["numero"] );
		$bairro = trim( $_POST["bairro"] );
		$cidade = trim( $_POST["cidade"] );
		$estado = trim( $_POST["estado"] );
		$cep = trim( $_POST["cep"] );


		$nascimento = formatardata( $nascimento );

		
		

		//verificar se o campo esta em branco
		if ( empty( $nome ) ) {
			echo "<script>alert('Preencha a nome');history.back();</script>";
		} else if ( empty( $nascimento ) ) {
			echo "<script>alert('Preencha o nascimento');history.back();</script>";
		} else if ( empty( $rg ) ) {
			echo "<script>alert('Preencha o rg');history.back();</script>";
		} else if ( empty( $cpfcnpj ) ) {
			echo "<script>alert('Preencha o cpf');history.back();</script>";
		} else if ( empty( $telefone ) ) {
			echo "<script>alert('Preencha o telefone');history.back();</script>";
		} else if ( empty( $email ) ) {
			echo "<script>alert('Preencha o email');history.back();</script>";
		} else if ( empty( $rua ) ) {
			echo "<script>alert('Preencha a rua');history.back();</script>";
		} else if ( empty( $numero ) ) {
			echo "<script>alert('Preencha o numero');history.back();</script>";
		} else if ( empty( $bairro ) ) {
			echo "<script>alert('Preencha o bairro');history.back();</script>";
		} else if ( empty( $cidade ) ) {
			echo "<script>alert('Preencha a cidade');history.back();</script>";
		} else if ( empty( $estado ) ) {
			echo "<script>alert('Preencha o estado');history.back();</script>";
		} else if ( empty( $cep ) ) {
			echo "<script>alert('Preencha o cep');history.back();</script>";
		} else {

			//verificar se o registro já existe
			$sql = "select * from cliente
			where cpfcnpj = ? and id <> ? limit 1";
			$consulta = $pdo->prepare($sql);
			$consulta->bindParam(1, $cpfcnpj);
			$consulta->bindParam(2, $id);
			$consulta->execute();
			$dados = $consulta->fetch(PDO::FETCH_OBJ);

			if((strlen($cpfcnpj)) < 14){
 
			//se o cnpj não ter no minimo 14 carateres
			echo "<script>alert('CPF inválido, mínimo 11 numeros.');history.back();</script>";
			exit;
 
			}

			if ( !empty( $dados->cpfcnpj) ) {
				//já existe um registro cadastrado
				echo "<script>alert('Já existe um cliente com este CPF/CNPJ');history.back();</script>";
				exit;


			}

			//verificar se o id esta vazio - insert

			if ( empty ( $id ) ) {
				//gravar no banco de dados
				$sql = "insert into cliente (id, nome, nascimento, rg, cpfcnpj, telefone, email, rua, numero, bairro, cidade, estado, cep ) values (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ? )";
				$consulta = $pdo->prepare($sql);
				//passar o parametro
				$consulta->bindParam(1, $nome);
				$consulta->bindParam(2, $nascimento);
				$consulta->bindParam(3, $rg);
				$consulta->bindParam(4, $cpfcnpj);
				$consulta->bindParam(5, $telefone);
				$consulta->bindParam(6, $email);
				$consulta->bindParam(7, $rua);
				$consulta->bindParam(8, $numero);
				$consulta->bindParam(9, $bairro);
				$consulta->bindParam(10, $cidade);
				$consulta->bindParam(11, $estado);
				$consulta->bindParam(12, $cep);
				




			} else {
				//dar update
				$sql = "update cliente set nome = ? , nascimento = ?, rg = ?, cpfcnpj = ?, telefone = ?, email = ?, rua = ?, numero = ?, bairro = ?, cidade = ?, estado = ?, cep = ? where id = ? limit 1";
				$consulta = $pdo->prepare( $sql );
				$consulta->bindParam(1, $nome);
				$consulta->bindParam(2, $nascimento);
				$consulta->bindParam(3, $rg);
				$consulta->bindParam(4, $cpfcnpj);
				$consulta->bindParam(5, $telefone);
				$consulta->bindParam(6, $email);
				$consulta->bindParam(7, $rua);
				$consulta->bindParam(8, $numero);
				$consulta->bindParam(9, $bairro);
				$consulta->bindParam(10, $cidade);
				$consulta->bindParam(11, $estado);
				$consulta->bindParam(12, $cep);
				$consulta->bindParam(13, $id );


			}

			//verificar se executou corretamente
			if ( $consulta->execute() ) {

				echo "<script>alert('Registro Salvo');location.href='listarCliente.php';</script>";

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