<?php


date_default_timezone_set("America/Sao_Paulo");
setlocale(LC_ALL, 'pt_BR');

  try {
    $servidor = "localhost";
    $banco = "pgmatrix";
    $usuario = "root";
    $senha = "";

    $pdo = new PDO ("mysql:host=$servidor;dbname=$banco;charset=utf8","$usuario","$senha");

  } catch (PDOException $e) {
    echo "Erro de Conexão " . $e->getMessage();
    exit;
  }