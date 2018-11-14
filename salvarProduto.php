<?php

	session_start();
		
		$permissao = $_SESSION["usuario"]["permissao"];
		if( $permissao == 'admin'){
			include "menu.php";
		}else{
			include "menufunc.php";
		}
		
	//verificar se foi post
	if ($_POST)	{

		$nomeImg = "";
	
	if ( ! empty ($_FILES["imagem"]["name"] ) ) {

		$tipo = $_FILES["imagem"]["type"];
		$tamanho = $_FILES["imagem"]["size"];
	
		// bytes em kbytes
		$tamanho = $tamanho / 1024;

		//formatar o tamanho
		$tamanho = number_format( 
			$tamanho, 
			3, 
			".", 
			"" 
		);

		//verificar se é um arquivo JPG
		if ( $tipo != "image/jpeg" ) {
			echo "<script>alert('Você pode enviar somente arquivos JPG. Formato enviado $tipo.');history.back();</script>";
		} else if ( $tamanho > 1024 ) {

			echo "<script>alert('Envie imagens de até 1 MB. Tamanho da imagem atual $tamanho Kb');history.back();</script>";
		} else if ( !copy( 
			$_FILES["imagem"]["tmp_name"], 
			"fotos/" . $_FILES["imagem"]["name"] ) ) {

			echo "<script>alert('Erro ao copiar arquivo');history.back();</script>";
		} else {

			//incluir o arquivo com a funcao
			include "config/imagem.php";
			
			$pastaFotos = "fotos/";
			$imagem = $pastaFotos . $_FILES["imagem"]["name"];
			$nomeImg = time();
			
			//echo $nome;

			LoadImg($imagem,$nomeImg,$pastaFotos);


		}
	} else if ( !empty ( $_POST["imagem"] ) ){
		$nomeImg = trim ( $_POST["imagem"] );

		

	}
		//salvar no banco de dados
		$id = trim ( $_POST["id"] );
		$nome = trim ( $_POST["nome"] );
		$descricao = trim ( $_POST["descricao"] );
		$id_marca = trim ( $_POST["id_marca"] );
		$estoque = trim ($_POST["estoque"]);
		$valor = trim($_POST["valor"]);
		$imagem = $nomeImg;
		
		//gravar no manco tudo em maiusculo
		
		$valor = formatarvalor($valor);

		if ( empty ( $id ) ) { 
			//inserir
			$sql = "insert into produto (nome, descricao, id_marca, estoque, valor, imagem)
			values (?, ?, ?, ?, ?, ?)";
			$consulta = $pdo->prepare( $sql );
			$consulta->bindParam( 1, $nome );
			$consulta->bindParam( 2, $descricao);
			$consulta->bindParam( 3, $id_marca );
			$consulta->bindParam( 4, $estoque);
			$consulta->bindParam( 5, $valor);
			$consulta->bindParam( 6, $imagem);
		} else {
			//atualizar


			$sql = "update produto set nome = ?, descricao = ?, id_marca = ?,estoque = ?, valor = ?, imagem = ? where id = ? limit 1";
			$consulta = $pdo->prepare( $sql );
			$consulta->bindParam( 1, $nome );
			$consulta->bindParam( 2, $descricao);
			$consulta->bindParam( 3, $id_marca );
			$consulta->bindParam( 4, $estoque);
			$consulta->bindParam( 5, $valor );
			$consulta->bindParam( 6, $imagem);
			$consulta->bindParam( 7, $id );
			

		}


		if ( $consulta->execute() ) {
			echo "<script>alert('Registro salvo');location.href='listarProduto.php';</script>";
		} else {
			echo "<script>alert('Erro ao salvar');history.back();</script>";
		}
	




	}