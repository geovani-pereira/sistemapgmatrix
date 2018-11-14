<?php
	//definindo que o arquivo será um json
	header("Content-type:application/json");
	//javascript object notation

	//conectar ao banco
	include "config/conecta.php";

	//selecionar todos os filmes
	$sql = "select id,nome,valor from servico order by nome;";
                            
	$consulta = $pdo->prepare($sql);
	$consulta->execute();

	while ( $dados = $consulta->fetch(PDO::FETCH_OBJ) ) {

		//deixar o titulo no formato "Xuxa - 2016"
		$dados->nome = $dados->nome;
		//guardar os dados em um array
		$array[] = $dados;

	}

	//formatar em json
	echo json_encode( $array );

	


