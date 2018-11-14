<?php
    session_start();
        
        $permissao = $_SESSION["usuario"]["permissao"];
        if( $permissao == 'admin'){
            include "menu.php";
           
        }else{
            include "menufunc.php";
        }
?>
<div id="wrapper">
    <div class="container-fluid">

        <div class="panel panel-edt">
            <div class="panel-heading panel-edt2"><h4 class="text-center panel-edt3"><i class="glyphicon glyphicon-tag"></i> Lista de Ordens</h4></div>
            <div class="panel-body">
                <a href="cadastroOs.php" title="Cadastro de Ordem de Serviço" class="btn btn-lg btn-success" style="margin: 30px;">
                    <i class="glyphicon glyphicon-file"></i>
                    Nova Ordem
                </a>
                <div class="clearfix"></div>
                <?php                
                //fazer o sql                
                $sql = "select os.id,os.datainicial,os.datafinal,os.status,u.nome as unome,c.nome,p.id as pid from cliente c inner join ordem os on(os.id_cliente = c.id) inner join usuario u on (os.id_usuario = u.id) left join parcela p on (os.id = p.id_ordem) group by id";

                 $consulta = $pdo->prepare($sql);
                 $consulta->execute();
                 ?>

                 <table class="tabela display nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <td width="1%">ID</td>
                            <td data-priority="1">Cliente</td>
                            <td width="10%">Usuario</td>
                            <td>Data Inicial</td>
                            <td>Data Final </td>
                            <td data-priority="2">Status</td>
                            <td>Pagamento</td>
                            <td width="12%">Opções</td>
                        </tr>
                    </thead>
<?php
                    while ($dados = $consulta->fetch(PDO:: FETCH_OBJ)) {


                        $id = $dados->id;
                        $cliente = $dados->nome;
                        $usuario = $dados->unome;
                        $datainicial = $dados->datainicial;
                        $datafinal = $dados->datafinal;
                        $status = $dados->status;
                        $datainicial = date('d/m/Y', strtotime($datainicial));
                        $datafinal = date('d/m/Y', strtotime($datafinal));
                        $parcela = $dados->pid;

                        //SQL da verificação se está pago ou não.
                        $faturamento = "select datapgto from parcela where id_ordem = ?";
                        $select  = $pdo->prepare($faturamento);
                        $select->bindParam(1,$id);
                        $select->execute();


                        $datapgto = "";

                        $dados2 = $select->fetch(PDO::FETCH_OBJ);
                        while($dados2 = $select->fetch(PDO:: FETCH_OBJ)){

                             $datapgto = $dados2->datapgto;    // verificando se pagamento está pago ou não

                        }
                        if (empty($datapgto)){
                            $pagamento = "Parcela Pendente";
                        }else{
                            $pagamento = "Pago";
                        }                    
                        // fim da verificação
                        //verificarndo se foi faturado
                        if(empty($parcela)){
                            // se não foi faturado inserir botão na tela usando a variavel $faturado para armazenar o HTML
                            $faturado = " <a href='faturar.php?os=$id' class='btn btn-primary'>
                            Faturar</a>";
                            $pagamento = "Pendente";

                        }else{
                            $faturado = "";                    
                        }
                        //fim da verificação    

    echo "<tr>
    <td>$id</td>
    <td>$cliente</td>
    <td>$usuario</td>
    <td>$datainicial</td>
    <td>$datafinal</td>
    <td>$status</td>
    <td>$pagamento $faturado</td>
    <td>
    <a href='editarOs.php?os=$id'	class='btn btn-warning'>
    <i class='glyphicon glyphicon-pencil'>
    </i>
    <a href='visualizarOs.php?os=$id' class='btn btn-info'>
    <i class='glyphicon glyphicon-search'></i>
    <a href='listarParcela.php?os=$id' class='btn btn-primary'>
    <i class='glyphicon glyphicon-usd'></i>
    </td>
    </tr>";
}
?>
</table>
</div>
</div>
</div>
</div>
<script type="text/javascript">
      $(document).ready(function() {
            $('.tabela').DataTable( {
                responsive: true,
                "info":     false,
                "order": [[ 0, "desc" ]],
                columnDefs: [
                { responsivePriority: 1, targets: 0 },
                { responsivePriority: 2, targets: -2 }
                ],
                "language": {
                    "lengthMenu": "Mostrando _MENU_ registros por página",
                    "zeroRecords": "Nenhum dado encontrado.",
                    "info": "Mostrando _PAGE_ de _PAGES_",
                    "infoEmpty": "Nenhum dado",
                    "infoFiltered": "(filtrado de _MAX_ total)",
                    "search": "Busca: ",  
                    "paginate": {
                        "previous": "Anterior",
                        "next": "Próxima",
                    }
                }
            } );
        } );
        </script>
