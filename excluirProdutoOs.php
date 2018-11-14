<?php

//iniciar a sessao
session_start();

//verificar se existe o id na sessao - logado
if (!isset($_SESSION["usuario"]["id"])) {
    //direcionar para o index
    header("Location: index.php");
}

//incluir o arquivo para conectar no banco
include "config/conecta.php";

$posid = $ordem = $idproduto = $quantidade = "";



if (isset($_GET["posid"])) {
    $posid = trim($_GET["posid"]);
}
if (isset($_GET["os"])) {
    $ordem = trim($_GET["os"]);
}
if (isset($_GET["idp"])) {
    $idproduto = trim($_GET["idp"]);
}


$sql3 = "select quantidade from produto_os where id_ordem = ? and id_produto = ?";
$consulta3 = $pdo->prepare($sql3);
$consulta3->bindParam(1, $ordem);
$consulta3->bindParam(2, $idproduto);
$consulta3->execute();

$dados = $consulta3->fetch(PDO::FETCH_OBJ);

$quantidade = $dados->quantidade;





if (empty($ordem)) {
    echo "<script>alert('Ordem de Serviço não encontrada');history.back();</script>";
}
if (empty($posid)) {
    echo "<script>alert('Produto não encontrado');history.back();</script>";
} else {

    if ($quantidade <= 1) {
        
        $sql2 = "update produto set estoque = estoque+1 where id = ?";
        $consulta2 = $pdo->prepare($sql2);
        $consulta2->bindParam(1, $idproduto);
        $sql = "delete from produto_os where 
		id = ? limit 1";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(1, $posid);
    } else {
        $sql2 = "update produto set estoque = estoque+1 where id = ?";
        $consulta2 = $pdo->prepare($sql2);
        $consulta2->bindParam(1, $idproduto);
        $sql = "update produto_os set quantidade = quantidade-1 where id = ? limit 1";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(1, $posid);
    }

    if ($consulta->execute() and $consulta2->execute()) {
        echo "<script>location.href='adicionarp.php?os=$ordem';</script>";
    } else {
        echo "<script>alert('Erro ao excluir produto da ordem de serviço');history.back();</script>";
    }
}
