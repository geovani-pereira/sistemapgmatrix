<?php
	//definindo que o arquivo será um json
	header("Content-type:application/json");
	//javascript object notation

	//conectar ao banco
	include "config/conecta.php";

	//selecionar todos os produtos
	$sql = "select p.id, p.nome, p.valor,p.estoque, m.marca from produto p inner join marca m on (m.id = p.id_marca) order by p.nome;";
                            
	$consulta = $pdo->prepare($sql);
	$consulta->execute();

	while ( $dados = $consulta->fetch(PDO::FETCH_OBJ) ) {

		
		$dados->nome = $dados->nome." - ".$dados->marca. "  - Estoque:".$dados->estoque;
		//guardar os dados em um array
		$array[] = $dados;

	}

	//formatar em json
	echo json_encode( $array );

	


