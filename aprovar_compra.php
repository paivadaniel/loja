<?php

require_once('conexao.php');

@session_start();
$id_usuario = @$_SESSION['id_usuario'];
//autor optou por pegar $_SESSION['cpf_usuario'], mas eu não, pois no checkout, o usuário pode alterar o cpf, e depois finalizar a compra e pagar

//atualiza o status da venda
//$id_venda não está nessa página, mas para chegar até aprovar_compra.php, obrigatoriamente tem que ser passado via GET o id_venda, e aprovar_compra.php abre como include em páginas que tem declarado $id_venda

//$id_venda = '74'; //para TESTAR VENDA coloque o id_venda gerado em carrinho
$pdo->query("UPDATE vendas SET pago = 'Sim' where id = '$id_venda'");

//incrementar o número de cartões fidelidade do cliente
$query = $pdo->query("SELECT * FROM usuarios where id = '$id_usuario'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$cpf_usuario = $res[0]['cpf'];

$query2 = $pdo->query("SELECT * FROM clientes where cpf = '$cpf_usuario'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
$cartoes = $res2[0]['cartoes'];
$email_cliente = $res2[0]['email'];

$total_cartoes = $cartoes + 1;

if ($total_cartoes >= $total_cartoes_troca_cupom) {
    $total_cartoes = 0;

	$data_cupom = date('Y-m-d', strtotime("+".$dias_uso_cupom." days")); //data limite para uso do cupom, e não a data de hoje
	$data_cupom_formatada = implode('/', array_reverse(explode('-', $data_cupom)));

    $pdo->query("INSERT INTO cupons (titulo, codigo, valor, data, id_usuario) VALUES ('Cupom por Cartões Fidelidade', '$cpf_usuario', '$valor_cupom_cartao', '$data_cupom', '$id_usuario')");

//ENVIAR EMAIL PARA O CLIENTE INFORMANDO QUE ELE JUNTOU O NÚMERO DE CARTÕES FIDELIDADE NECESSÁRIO E TEM DIREITO A UTILIZAR UM CUPOM DE DESCONTO NO PRAZO DE X DIAS A PARTIR DA DATA DE RECEBIMENTO DO EMAIL
$destinatario = $email_cliente;
$assunto = 'Novo Cupom de Desconto - ' . $nome_loja;
$remetente = $email_loja;
$mensagem_email = utf8_decode('Parabéns, você ganhou um novo cupom de desconto no valor de '.$valor_cupom_cartao.' reais, poderá usar até o dia ' . $data_cupom_formatada . '. O seu código para uso do cupom é '.$cpf_usuario);
$mensagem_sem_codific = 'Parabéns, você ganhou um novo cupom de desconto no valor de '.$valor_cupom_cartao.' reais, poderá usar até o dia ' . $data_cupom_formatada . '. O seu código para uso do cupom é '.$cpf_usuario; //sem utf8_decode
$cabecalhos = 'From: ' . $remetente;
@mail($destinatario, $assunto, $mensagem_email, $cabecalhos);

    //informar por mensagem (que ficará no painel-cliente) do cupom ganho da ultima compra
    $pdo->query("INSERT mensagens SET id_venda = '$id_venda', mensagem = '$mensagem_sem_codific', usuario = 'Admin', data = curDate(), hora = curTime()");


}

$pdo->query("UPDATE clientes SET cartoes = '$total_cartoes' where cpf = '$cpf_usuario'");

//incrementa uma venda nos produtos

$query = $pdo->query("SELECT * FROM carrinho where id_venda = '$id_venda'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);

for ($i = 0; $i < @count($res); $i++) {
    foreach ($res[$i] as $key => $value) {
    }

    $id_produto = $res[$i]['id_produto'];

    $query2 = $pdo->query("SELECT * FROM produtos where id = '$id_produto'");
    $res2 = $query2->fetchAll(PDO::FETCH_ASSOC);

    $vendas_produto = $res2[$i]['vendas'];
    $vendas_produto += 1;

    $pdo->query("UPDATE produtos SET vendas = '$vendas_produto' where id = '$id_produto'");
}

//ENVIAR EMAIL PARA O CLIENTE INFORMANDO DA COMPRA
$destinatario = $email_cliente;
$assunto = 'Compra Aprovada - ' . $nome_loja;
$remetente = $email_loja;
$mensagem_email = utf8_decode('Sua compra foi aprovada! Acesse o painel do cliente para acompanhar o andamento do pedido.');
$cabecalhos = 'From: ' . $remetente;
@mail($destinatario, $assunto, $mensagem_email, $cabecalhos);
