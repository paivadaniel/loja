<?php

require_once('../../conexao.php');
//verificar.php requerido em painel-cliente/index.php já executa session_start()

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

<?php 

$query = $pdo->query("SELECT * FROM usuarios where id = '$id_usuario'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$cpf_usuario = $res[0]['cpf'];

$query = $pdo->query("SELECT * FROM clientes where cpf = '$cpf_usuario'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$cartoes_cliente = @$res[0]['cartoes'];

?>

<h5 class="mt-3">Cartões Fidelidade</h5>
<p class="text-muted"><small>Ao completar <?php echo $total_cartoes_troca_cupom ?> cartões você ganhará um cupom de desconto de R$ <?php echo $valor_cupom_cartao ?>,00! 
<?php if($cartoes_cliente == 0){ //mensagem para aparecer na home mostrando o número de cartões do usuário
	echo 'Você não efetuou nenhuma compra ainda, faça a sua primeira compra e ganhe seu primeiro cartão!';
}else{
	echo 'Você possui '.$cartoes_cliente.' Cartões!';
} ?>
</small></p>

<div class="row">
<?php 
for ($i=1; $i <= $total_cartoes_troca_cupom; $i++) { 
	if($i <= $cartoes_cliente){
		$img = 'logo-maior.png';
	}else{
		$img = 'logo-inativa.png';
	}
 ?>

 	  <div class="col-md-2 ml-2 " align="center">
        <img src="../../img/<?php echo $img ?>" width="180">
      </div>

 <?php } ?>

 </div>

