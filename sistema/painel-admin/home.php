<?php

require_once('../../conexao.php');
//verificar.php requerido em painel-cliente/index.php já executa session_start()

//verificar se tem registros no carrinho com mais de x dias
$data_carrinho = date('Y-m-d', strtotime("-" . $dias_limpar_carrinho . " days")); //hoje é dia 12/09/2022, data_carrinho vai ser então 09/09/2022, porém, não está com essa formatação

$res = $pdo->query("SELECT * from carrinho where data <= '$data_carrinho' and id_venda = 0"); //id_venda = 0 pois a venda ainda não ocorreu
$dados = $res->fetchAll(PDO::FETCH_ASSOC);

for ($i = 0; $i < count($dados); $i++) {
    foreach ($dados[$i] as $key => $value) {
    }

    $id_produto = $dados[$i]['id_produto'];
    $id_carrinho = $dados[$i]['id'];
    $combo = $dados[$i]['combo'];

    if ($combo != 'Sim') { //se for produto

        $query_c = $pdo->query("SELECT * from carac_prod WHERE id_prod = '$id_produto'");
        $res_c = $query_c->fetchAll(PDO::FETCH_ASSOC);
        $total_prod_carac = @count($res_c);

        if ($total_prod_carac > 0) { //isto é, se o produto tiver características a adicionar

            /* para mim o SELECT abaixo é desnecessário, e bastava apenas:
                $pdo->query("DELETE FROM carac_itens_carrinho where id_carrinho = '$id'");
    
                ou seja, podia remover o SELECT, e o FOR, já que a linha acima apagaria todas as linhas com id_carrinho = $id
    
                porém, como minha atribuição de característica está com problema, não consigo testar
            */
            $query2 = $pdo->query("SELECT * from carac_itens_carrinho WHERE id_carrinho = '$id_carrinho'");
            $res2 = $query2->fetchAll(PDO::FETCH_ASSOC);

            for ($i2 = 0; $i2 < count($res2); $i2++) {
                foreach ($res2[$i2] as $key => $value) {
                }
                $pdo->query("DELETE FROM carac_itens_carrinho where id_carrinho = '$id_carrinho'");
                
            }
        }
    }

    $pdo->query("DELETE FROM carrinho where id = '$id_carrinho'"); //não precisa de where data <= '$data_carrinho' and id_venda = 0, pois já está dentro de um for que está pegando id_carrinho considerando essa condição (primeiro SELECT feito)

}



$id_usuario = $_SESSION['id_usuario'];

$totalPedidos = 0;
$pedidosFinalizados = 0;
$aguardandoPagamento = 0;
$aguardandoEntrega = 0;

$query = $pdo->query("SELECT * FROM vendas where id_usuario = '$id_usuario'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$totalPedidos = @count($res);

for ($i = 0; $i < $totalPedidos; $i++) {
    foreach ($res[$i] as $key => $value) {
    }

    $pago = $res[$i]['pago']; //sim, não
    $status = $res[$i]['status']; //não enviado, enviado, entregue, disponível

    if ($pago == 'Sim') {
        if ($status == 'Entregue') {
            $pedidosFinalizados += 1;
        }
    } else {
        $aguardandoPagamento += 1;
    }

    if ($status == 'Não Enviado' || $status == 'Enviado') {
        $aguardandoEntrega += 1;
    }
}
?>


<div class="row">

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total de Pedidos</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo @$totalPedidos ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-home fa-2x text-primary"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold <?php echo $classeValor ?> text-uppercase mb-1">Pedidos Finalizados</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo @$pedidosFinalizados ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-success"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-danger shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Aguardando Pagamento</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo @$aguardandoPagamento ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clipboard-list fa-2x text-danger"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Aguardando Entrega</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo @$aguardandoEntrega ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-users fa-2x text-warning"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>