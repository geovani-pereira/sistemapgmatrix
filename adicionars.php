<?php
//iniciar a sessao

$valor = "";
session_start();

//verificar se existe o id na sessao - logado
if (!isset($_SESSION["usuario"]["id"])) {
    //direcionar para o index
    header("Location: index.php");
}

//incluir o arquivo para conectar no banco
include "config/conecta.php";



if (isset($_GET["os"])) {
    $ordem = trim($_GET["os"]);
}

function formatarvalor($valor) {
    $valor = str_replace( ".", "", $valor);
        //busca - valor para substituir - variavel
    
    $valor = str_replace( ",", ".", $valor);
    
        //retornar um valor
    return $valor;
}


//verificar se foi dado post
if ($_POST) {

    $ordem = $_POST["os_id"];
    $servico_id = $_POST["id_servico"];
    $valor = $_POST["valor"];
    
    $valor = formatarvalor($valor);
    

    $sql = "INSERT INTO servico_os (id_ordem, id_servico, valor) VALUES (?, ?, ?)";

    $consulta = $pdo->prepare($sql);
    $consulta->bindParam(1, $ordem);
    $consulta->bindParam(2, $servico_id);
    $consulta->bindParam(3, $valor);

    if ($consulta->execute()) {


        echo "<p class='alert alert-success'>Serviço adicionado com sucesso! </p>";
    } else {
        $erro = $consulta->errorInfo()[2]; // uso do programardor 
        echo "<p class='alert alert-danger'>Erro ao adicionar serviço, informe um serviço cadastrado.</p>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Adicionar Serviço</title>
    <meta charset="utf-8">

    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">

    <script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/estilo.css">
</head>
<body>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">

            <thead>
                <tr>
                    <td width="5%">Excluir</td>
                    <td>ID</td>                                
                    <td>Serviço</td>
                    <td>Descrição</td>
                    <td>Subtotal</td>		

                </tr>
            </thead>
            <?php
            $sql = "SELECT s.id, sos.id_ordem,sos.valor as sosval,sos.id as sosid,s.nome,s.descricao FROM servico_os sos INNER JOIN servico s ON ( s.id = sos.id_servico ) WHERE sos.id_ordem = ? ORDER BY s.nome";

            $consulta = $pdo->prepare($sql);
            $consulta->bindParam(1, $ordem);
            $consulta->execute();
            
            $v = 0;
            $total = 0;

            while ($dados = $consulta->fetch(PDO::FETCH_OBJ)) {

                $id = $dados->id;
                $nome = $dados->nome;
                $descricao = $dados->descricao;
                $sosid = $dados->sosid;
                $valor = $dados->sosval;

                $ordem = $dados->id_ordem;
                
                
                
                $v = $v + $valor;
                
                $valor = number_format($valor, 2, ",", ".");

                
                

                

                echo "
                <tr>                                
                <td>					
                <a href='javascript:excluir($ordem,$sosid)' class='btn btn-danger'>
                <i class='glyphicon glyphicon-trash'></i>
                </a>
                </td>
                <td>$id</td>                                        
                <td>$nome</td>
                <td>$descricao</td>
                <td>R$$valor</td>     
                </tr>
                ";
            }

//Formatar o Valor Total
            $total = $total + $v;
            $total = number_format($total, 2, ",", ".");
            $total = "Total em Serviços R$ " . $total;
            ?>
        </table>
    </div>

    <script type="text/javascript">

            //funcao para excluir
            function excluir(ordem, sosid) {
                //perguntar se deseja mesmo exluir

                if (confirm("Deseja mesmo exluir ? ")) {

                    location.href = "excluirServicoOs.php?sosid=" + sosid + "&os=" + ordem;

                }
            }

            //ADicionar valor Total ao valor total fora do IFRAME

        </script>

        <div class="alert text-right alert-info" id="totalServicos" role="alert"><?= $total ?></div>

    </body>
    </html>