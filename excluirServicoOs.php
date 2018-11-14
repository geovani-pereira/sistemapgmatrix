<?php
	//iniciar a sessao
	session_start();

	//verificar se existe o id na sessao - logado
	if ( !isset( $_SESSION["usuario"]["id"] ) ) {
		//direcionar para o index
		header( "Location: index.php" );
	}

	//incluir o arquivo para conectar no banco
	include "config/conecta.php";

	$sosid = $ordem = "";

	if ( isset ( $_GET["sosid"] ) ){
		$sosid = trim ( $_GET["sosid"] );
        }
        if ( isset ( $_GET["os"] ) ){
		$ordem = trim ( $_GET["os"] );
        }
        
        if (empty ( $ordem)){
            echo "<script>alert('Ordem de Serviço não encontrada');history.back();</script>";
        }
	if ( empty ( $sosid ) ) {
		echo "<script>alert('Produto não encontrado');history.back();</script>";
	} else {
           
                
		$sql = "delete from servico_os where 
		id = ? limit 1";
		$consulta = $pdo->prepare($sql);
		$consulta->bindParam(1, $sosid);
		

		if ( $consulta->execute() ) {
			echo "<script>location.href='adicionars.php?os=$ordem';</script>";
		} else {
			echo "<script>alert('Erro ao excluir produto da ordem de serviço');history.back();</script>";
		}
	}
