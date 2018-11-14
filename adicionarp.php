
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/estilo.css">
<?php
//iniciar a sessao
$quantidade = $qtd = $id = $unitario = "";


session_start();

//verificar se existe o id na sessao - logado
if (!isset($_SESSION["usuario"]["id"])) {
    //direcionar para o index
    header("Location: index.php");
}

//incluir o arquivo para conectar no banco
include "config/conecta.php";

if (isset($_GET["os"])) { // veriifcando se existe os vindo por get
    $ordem = trim($_GET["os"]); 
}


//verificar se foi dado post
if ($_POST) {

    $ordem = $_POST["os_id"];   //pegando id da ordem de serviço por get
    $produto_id = $_POST["id_produto"]; //pegando id do produto por get
    $quantidade = $_POST["quantidade"]; // pegando quantidade por get

    

   if ($quantidade <= 0){ // se quantidade for menos que 0 quantidade recebe 1
     $quantidade = 1;    
 }
 if($produto_id<=0){
  
  
   echo "<p class='alert alert-danger'>Erro ao adicionar produto, informe um produto cadastrado.</p>";
   exit;
   
}




    $sqlproduto = "select * from produto where id = ? limit 1;";        // select para somar o valor
    $consulta = $pdo->prepare($sqlproduto);
    $consulta->bindParam(1,$produto_id);
    $consulta->execute();
    $dados = $consulta->fetch(PDO::FETCH_OBJ);
    
    $unitario = $dados->valor;
    $estoque = $dados->estoque;
    
    $valor = $quantidade * $unitario;


    $sql2 = "SELECT * FROM produto_os WHERE id_ordem = ? AND id_produto = ? LIMIT 1";
    $consulta2 = $pdo->prepare($sql2);
    $consulta2->bindParam(1, $ordem);
    $consulta2->bindParam(2, $produto_id);
    $consulta2->execute();


    $dados = $consulta2->fetch(PDO::FETCH_OBJ);
    
    if ($estoque >= $quantidade){
        
      
        if (empty($dados->id)) {
            $sql = "INSERT INTO produto_os (id, quantidade, id_ordem, id_produto, valor) VALUES (null, ?, ?, ?,?)";
            $consulta = $pdo->prepare($sql);
            $consulta->bindParam(1, $quantidade);
            $consulta->bindParam(2, $ordem);
            $consulta->bindParam(3, $produto_id);
            $consulta->bindParam(4, $valor);
            
        $sql3 = "update produto set estoque = estoque-1 where id = ? and estoque >1"; //tirando um produto do estoque
        $consulta3 = $pdo->prepare($sql3);
        $consulta3->bindParam(1,$quantidade);
        
        
        
    } else {

        
        $sql = "update produto_os set quantidade = ?, id_ordem = ?,id_produto = ?,valor = ? where id = ? limit 1";
        
        
        
        $qtd = $dados->quantidade; // recebendo quantidade do sql2 
        $id = $dados->id;
        $qtd = $qtd + $quantidade;
        
        $valor = $qtd * $unitario;
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(1, $qtd);
        $consulta->bindParam(2, $ordem);
        $consulta->bindParam(3, $produto_id);
        $consulta->bindParam(4, $valor);
        $consulta->bindParam(5, $id);
        
        $sql3 = "update produto set estoque = estoque-? where id = ?";
        $consulta3 = $pdo->prepare($sql3);
        $consulta3->bindParam(1,$quantidade);
        $consulta3->bindParam(2,$produto_id);
    }


    $verifica =   "select p.datapgto as pagamento from parcela p inner join ordem os on (p.id_ordem = os.id) where id_ordem = ?";

    $consulta4 = $pdo->prepare($verifica);
    $consulta4->bindParam(1,$ordem);
    $consulta4->execute();
    $dadosverifica = $consulta4->fetch(PDO::FETCH_OBJ);
    

    if(empty($dadosverifica->pagamento)){
       if ($consulta->execute() and $consulta3->execute()) {
        echo "<p class='alert alert-success'>Produto adicionado com sucesso! </p>";
    } else {
        $erro = $consulta->errorInfo()[2]; // uso do programador
        echo "<p class='alert alert-danger'>Erro ao adicionar produto, informe um produto cadastrado.</p>";
    }
}else{

    echo "<script>alert('O pagamento desta ordem de serviço esta em andamento, operação não permitida.');history.back();</script>";

}





}else{
    
    echo "<p class='alert alert-danger'>Item esgotado.</p>";
}



}

?>



<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>



<div class="table-responsive">
    <table class="table table-bordered table-striped table-hover">
        
        <thead>
            <tr>
                <td width="5%">Excluir</td>
                <td>ID</td>
                <td>Quantidade</td>
                <td>Produto</td>
                <td width="10%">Foto</td>
                <td>Unitário</td>
                <td>Subtotal</td>
                

                
            </tr>
        </thead>
        <?php
        $sql = "SELECT pos.quantidade,pos.valor as posval,p.id,pos.id as posid, pos.id_ordem, p.valor, p.nome,p.imagem, pos.id_produto FROM produto_os pos INNER JOIN produto p ON ( p.id = pos.id_produto ) WHERE pos.id_ordem = ? ORDER BY p.nome";




        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(1, $ordem);
        $consulta->execute();
        $total = 0;



        while ($dados = $consulta->fetch(PDO::FETCH_OBJ)) {

            $id = $dados->id;
            $quantidade = $dados->quantidade;
            $nome = $dados->nome;
            $valor = $dados->valor;
            $ordem = $dados->id_ordem;
            $posid = $dados->posid;
            $imagem = $dados->imagem;
            


            $v = $valor * $quantidade;
            $total += $v;
            $v = number_format($v, 2, ",", ".");
            $valor = number_format($valor, 2, ",", ".");

            $imagem = $imagem . "p.jpg";
            $img = "<img src='fotos/$imagem'
            width='100'>";					

            $v= "R$" . $v;


            echo "
            <tr>
            
            <td>
            
            <a href='javascript:excluir($posid,$ordem,$id)' class='btn btn-danger'>
            <i class='glyphicon glyphicon-trash'></i>
            </a>

            </td>
            <td>$id</td>
            <td>$quantidade</td>
            <td>$nome</td>  
            <td>$img</td>
            <td>R$$valor</td>    
            <td>$v</td>
            
            
            </tr>
            
            ";
        }

//Formatar o Valor Total
        $total = number_format($total, 2, ",", ".");
        $total = "Total em Produtos : R$ " . $total;
        ?>
    </table>
</div>

<script type="text/javascript">

            //funcao para excluir
            function excluir(posid, ordem, id) {
                //perguntar se deseja mesmo exluir
                if (confirm("Deseja mesmo exluir ? ")) {
                    console.log(id);
                    location.href = "excluirProdutoOs.php?posid=" + posid + "&os=" + ordem + "&idp=" + id;

                }
            }

            

        </script>
        
        <div class="alert text-right alert-info" id="totalProdutos" role="alert" id="total"><?=$total?></div>
        
