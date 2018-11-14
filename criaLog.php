<?php
date_default_timezone_set("America/Sao_Paulo");
setlocale(LC_ALL, 'pt_BR');


//ABAIXO CRIAMOS A FUNÇÃO QUE IRÁ AUTOMATIZAR A CRIAÇÃO DOS LOGS NO BANCO
function logs($x,$id_usuario){     // RECEBE POR PARAMETRO A VARIÁVEL $x QUE SERÁ A MENSAGEM A SER GRAVADA NO BANCO DE DADOS. 
 
	$IP = $_SERVER['REMOTE_ADDR']; // SALVA O IP DO VISITANTE
	$HORA = date('Y-m-d H:i:s'); // SALVA A DATA E HORA ATUAL (formato MySQL)
	$id_usuario  = $_SESSION["usuario"]["id"];
	include "config/conecta.php";
        
	// MONTANDO A QUERY PARA INSERIR NO BANCO DE DADOS
	$sql = "INSERT INTO logs (id,id_usuario,hora,ip,alteracao) VALUES (null,?,?,?,?)";  //ONDE "$x" É A VARIÁVEL QUE ARMAZENA A MENSAGEM QUE VOCÊ QUER INSERIR NO BANCO
        $insert = $pdo->prepare($sql);
        $insert->bindParam(1, $id_usuario);
        $insert->bindParam(2, $HORA);
        $insert->bindParam(3, $IP);
        $insert->bindParam(4, $x);
    
                
 
	if ($insert->execute()){ // EXECUTA A QUERY OU MOSTRA O ERRO, CASO OCORRA. 
			 return true;   //VERIFICA  SE DEU CERTO, SE SIM RETORNA TRUE

			 
	}   								
 
	else{
			 return false; // VERIFICA  SE DEU ERRADO, SE SIM,  RETORNA FALSE    
			 
 
	}
 
 
}
logs($x,$id_usuario); // AQUI CHAMAMOS A FUNÇÃO QUE CRIAMOS PARA EXECUTAR A INSERÇÃO NO BANCO DE DADOS
 
 
 

 
