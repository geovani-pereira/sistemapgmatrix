<?php

  session_start();
    
    $permissao = $_SESSION["usuario"]["permissao"];
    if( $permissao == 'admin'){
      include "menu.php";
    }else{
      include "menufunc.php";
    }

  $id_usuario  = $_SESSION["usuario"]["id"];



  if ( $_POST ) {

   

    //recuperar os dados do formulário
    //print_r( $_POST );
    $id = trim( $_POST["id"] );
    $datavcto = trim( $_POST["datavcto"]);
    $datapgto = trim ($_POST["datapgto"]);



      //verificar se o registro já existe
      $sql = "select * from parcela
      where id = ? limit 1";
      // <> diferente
      $consulta = $pdo->prepare($sql);
      $consulta->bindParam(1, $id);
      $consulta->execute();
      $dados = $consulta->fetch(PDO::FETCH_OBJ);

      $id_ordem = $dados->id_ordem;

     if(!empty($datapgto)){

    $datapgto = formatardata($datapgto);
    $datavcto = formatardata($datavcto);

    $sql = "update parcela set datapgto = ?, datavcto = ? where id = ?";
    $consulta = $pdo->prepare($sql);
    $consulta->bindParam(1,$datapgto);
    $consulta->bindParam(2,$datavcto);
    $consulta->bindParam(3, $id);

     

    if ( $consulta->execute() ) {

      $x = " DataPgto: " . $datapgto. " DataVcto: " . $datavcto. " Parcela: " . $id . " Ordem: " . $id_ordem;

        include_once "criaLog.php";
     
      //enviar para a listagem
      echo "<script>location.href='listarParcela.php?os=$id_ordem';</script>";
    } else {
      echo "erro";
      //deu erro avisar
      echo"<script>alert('Erro editar parcela !';history.back();)</script>";
    }
    
    }elseif (empty($datapgto)){

    $datapgto = null;
    

  
    $datavcto = formatardata($datavcto);

    $sql = "update parcela set datavcto = ? where id = ?";
    $consulta = $pdo->prepare($sql);
    $consulta->bindParam(1,$datavcto);
    $consulta->bindParam(2, $id);


    //vereficar se excutou corretamente
    if ( $consulta->execute() ) {
      $x = " DataVcto: " . $datavcto. " Parcela: " . $id . " Ordem: " . $id_ordem;

        include_once "criaLog.php";
      //enviar para a listagem
      echo "<script>location.href='listarParcela.php?os=$id_ordem';</script>";
    } else {
      echo "erro";
      //deu erro avisar
      echo"<script>alert('Erro editar parcela !';history.back();)</script>";
    }

    }else{
      echo "teste";

      

      echo "<script>alert('Parcela PAGA !';history.back();)</script>";

    }

}

