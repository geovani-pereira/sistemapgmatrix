<?php

    session_start();
        
        $permissao = $_SESSION["usuario"]["permissao"];
        if( $permissao == 'admin'){
            include "menu.php";
           
        }else{
            include "menufunc.php";
        }


if ($_POST['cliente']) {

    //recuperar os dados
    $id = trim($_POST["id"]);
    $datainicial = trim($_POST["datainicial"]);
    $datafinal = trim($_POST["datafinal"]);
    $descricao = trim($_POST["descricao"]);
    $observacao = trim($_POST["observacao"]);
    $status = trim($_POST["status"]);
    $cliente = trim($_POST["cliente"]);
    $id_cliente = trim($_POST["id_cliente"]);
    $id_usuario = trim($_POST["id_usuario"]);
    $datainicial = formatardata($datainicial);
    $datafinal = formatardata($datafinal);
        
    
    //verificar se tem id
    if (empty($id)) {
        //insert no banco de dados

        $sql = "insert into ordem (datainicial, datafinal, descricao, status, observacao, id_cliente, id_usuario) values (?, ?, ?, ?, ?, ?, ?)";

        
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(1, $datainicial);
        $consulta->bindParam(2, $datafinal);
        $consulta->bindParam(3, $descricao);
        $consulta->bindParam(4, $status);
        $consulta->bindParam(5, $observacao);
        $consulta->bindParam(6, $id_cliente);
        $consulta->bindParam(7, $id_usuario);    

        
        //--------------------
        
        //executa o sql
        if ($consulta->execute()) {
         //se executar
            $id = $pdo->lastInsertId();

              //Função para LOG--------
        $x = " Status: " . $status. " OS: " . $id;

        include "criaLog.php";
        
        //--------------------            
            echo "<script>location.href='editarOs.php?os=$id';</script>";
        } else {
            //se der erro
            $erro = $consulta->errorInfo()[2];
            echo "<script>alert('Erro ao salvar:' $erro);history.back();</script>";
        }
    } else {


          $verifica =   "select p.datapgto as pagamento,os.status as statusos from parcela p inner join ordem os on (p.id_ordem = os.id) where id_ordem = ?";

          $consulta = $pdo->prepare($verifica);
          $consulta->bindParam(1,$id);
          $consulta->execute();
          $dados = $consulta->fetch(PDO::FETCH_OBJ);

          if(empty($dados->pagamento) || ($dados->statusos === "Em Andamento")){
            $sql = "update ordem set datainicial = ?, datafinal = ?, descricao = ?, status = ?, observacao = ?, id_cliente = ?, id_usuario = ? where id = ? limit 1";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(1, $datainicial);
        $consulta->bindParam(2, $datafinal);
        $consulta->bindParam(3, $descricao);
        $consulta->bindParam(4, $status);
        $consulta->bindParam(5, $observacao);
        $consulta->bindParam(6, $id_cliente);
        $consulta->bindParam(7, $id_usuario);
        $consulta->bindParam(8, $id);
        
        //Função para LOG ----------------
        $x = "Status:".$status. "/OS:" . $id. "/Data Final: " . $datafinal. "/Cliente: ". $id_cliente;       
        include_once "criaLog.php";
        
        //----------------------------------

        if ($consulta->execute()) {           
            echo "<script>location.href='listarOs.php';</script>";

            exit;
        } else {            
            echo "<script>alert('Erro ao atualizar');history.back();</script>";
            exit;
        }

          }else if (!empty($dados->pagamento)){
          echo "<script>alert('O pagamento desta ordem de serviço esta em andamento ou finalizado, operação não permitida.');history.back();</script>";
          exit;

          }


        
    }
}