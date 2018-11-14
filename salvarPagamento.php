<?php
$id = 0;
  session_start();
    
    $permissao = $_SESSION["usuario"]["permissao"];
    if( $permissao == 'admin'){
      include "menu.php";

    }else{
      include "menufunc.php";
    }

    $id_usuario  = $_SESSION["usuario"]["id"];

$datavcto = $datavcto1 = $datavcto2 = $datavcto3 = $datavcto4 = date('d/m/y');

if ($_POST) {
    //verificar se foi post

        //salvar no banco de dados


    $id_ordem = trim( $_POST["id_ordem"] );
    $valor = trim( $_POST["valor_parcela"] );
    $datavcto1 = trim( $_POST["datavcto"] );
    $datavcto2 = trim( $_POST["datavcto2"] );
    $datavcto3 = trim( $_POST["datavcto3"] );
    $datavcto4 = trim( $_POST["datavcto4"] );
    $parcela = trim ($_POST["n-parcelas"]);
    $total = ($_POST)["total"];
    $valor = formatarvalor($valor);
    $teste = $valor;
    $total = formatarvalor($total);



    $valor_quebrado = round(($total/$parcela),2);
    $valor_quebrado_total = round($total-($valor_quebrado*$parcela),2);




    $sql = "select id from parcela where id_ordem = ?";
    $consulta = $pdo->prepare( $sql );
    $consulta->bindParam( 1, $id_ordem );
    $consulta->execute();
    if( $dados = $consulta->fetch(PDO::FETCH_OBJ)){
      $id = $dados->id;
    }

   


    if(empty($id)){

        $i = 1;

        while($i <= $parcela ){

          if ($i==$parcela) $valor_quebrado=$valor_quebrado+$valor_quebrado_total;
          $valor = $valor_quebrado;
          



           $datavcto =   "$"."datavcto".(string)($i);


           $datavcto = formatardata( eval("return $datavcto;") );





           $sql = "insert into parcela (id_ordem, valor, datavcto)
           values (?, ?, ?)";


           $consulta = $pdo->prepare( $sql );
           $consulta->bindParam( 1, $id_ordem );
           $consulta->bindParam( 2, $valor);
           $consulta->bindValue( 3, $datavcto);




           $i++;
           if ( $consulta->execute() ) {

            $x = " Ordem: " . $id_ordem. " Valor Parcela: " . $valor . " Parcelas: " . $parcela;

            include_once "criaLog.php";

            
            echo "<script>alert('Registro salvo');location.href='listarParcela.php?os=$id_ordem';</script>";

        } else {
            echo "<script>alert('Erro ao Faturar');history.back();</script>";
        }

    }

}else{

   $verificar = "select datapgto from parcela where id_ordem = ?"; 
   $consulta2= $pdo->prepare($verificar);
   $consulta2->bindParam(1,$id_ordem);
   $consulta2->execute();
   $dados = $consulta2->fetch(PDO::FETCH_OBJ);
   $teste = $dados->datapgto;



   if(empty($teste)){

       $delete = "delete from parcela where id_ordem = ? and datapgto is null";
       $consulta2 = $pdo->prepare( $delete );
       $consulta2->bindParam(1,$id_ordem);
       $consulta2->execute();
       $no=$consulta2->rowCount();



       if($no < 1){

        echo "<script>alert('Erro ao Faturar');history.back();</script>";
    }else{

       $i = 1;
       while($i <= $parcela ){

            // se i for igual numero de parcelas valor quebrado recebe ele + o resto
            if ($i==$parcela) $valor_quebrado=$valor_quebrado+$valor_quebrado_total;
          $valor = $valor_quebrado;




           $datavcto =   "$". "datavcto".(string)($i);


           $datavcto = formatardata( eval("return $datavcto;") );


           $sql = "insert into parcela (id_ordem, valor, datavcto)
           values (?, ?, ?)";


           $consulta = $pdo->prepare( $sql );
           $consulta->bindParam( 1, $id_ordem );
           $consulta->bindParam( 2, $valor);
           $consulta->bindValue( 3, $datavcto);





           $i++;
           if ( $consulta->execute() ) {

            $x = " Ordem: " . $id_ordem. " Valor Parcela: " . $valor . " Parcelas: " . $parcela;

            include_once "criaLog.php";


            echo "<script>alert('Registro salvo');location.href='listarParcela.php?os=$id_ordem';</script>";
        } else {
            echo "<script>alert('Erro ao Faturar');history.back();</script>";
        }

    }


}
}else {
    echo "<script>alert('O pagamento desta ordem está em andamento');location.href='listarParcela.php?os=$id_ordem';</script>";
}   
}





         /*else {
            //atualizar

            $sql = "update financeiro set id_cliente = ?, id_ordem = ?, descricao = ?, valor = ?, data = ?, tipo = ? where id = ? limit 1";
            $consulta = $pdo->prepare( $sql );
            $consulta->bindParam( 1, $id_cliente );
            $consulta->bindParam( 2, $id_ordem);
            $consulta->bindParam( 3, $descricao);
            $consulta->bindParam( 4, $valor );
            $consulta->bindParam( 5, $data);
            $consulta->bindParam( 6, $tipo);
            $consulta->bindParam( 7, $id );

        }


        if ( $consulta->execute() ) {
            echo "<script>alert('Registro salvo');location.href='listarFinanceiro.php';</script>";
        } else {
            echo "<script>alert('Erro ao salvar');history.back();</script>";
        }
    



*/
    }
    ?>
