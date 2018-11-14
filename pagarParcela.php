<?php 
		session_start();
		
		$permissao = $_SESSION["usuario"]["permissao"];
		if( $permissao == 'admin'){
			include "menu.php";
		}else{
			include "menufunc.php";
		}

		$id_usuario  = $_SESSION["usuario"]["id"];

	$id = "";
	//recuperar o id enviado por GET
	if ( isset ( $_GET["id"] ) ) {
		$id = trim ( $_GET["id"] );
	}

	$datapgto = date("d/m/Y");

	

	$datapgto = formatardata($datapgto);
	
	//vereficar se existe um marca com esta categoria
	$sql = "select * from parcela where id = ? limit 1";

	$consulta = $pdo->prepare($sql);
	$consulta->bindParam(1, $id);
	$consulta->execute();

	$dados = $consulta->fetch(PDO::FETCH_OBJ);

	$id_ordem = $dados->id_ordem;

	//vereicar se trouxe o registros
	if ( empty( $dados->datapgto ) ) {
		//excluir
		$sql = "update parcela set datapgto = ? where id = ?";
		$consulta = $pdo->prepare($sql);
		$consulta->bindParam(1,$datapgto);
		$consulta->bindParam(2, $id);
		//vereficar se excutou corretamente
		if ( $consulta->execute() ) {
			 $x = " DataPgto: " . $datapgto. " Parcela: " . $id . " Ordem: " . $id_ordem;

        	include_once "criaLog.php";

			//enviar para a listagem
			echo "<script>location.href='listarParcela.php?os=$id_ordem';</script>";
		} else {
			//deu erro avisar
			echo"<script>alert('Erro a pagar parcela !';history.back();)</script>";
		}

	} else {
		//mensagem de erro
		echo "<script>alert('Não e possivel pagar esta parcela, pois ela ja esta paga');history.back();</script>";
	}
