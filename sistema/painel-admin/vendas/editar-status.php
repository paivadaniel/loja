<?php

require_once('../../../conexao.php');

$id_venda = $_POST['txtid2'];
$status_rastreio = $_POST['status_rastreio'];
$codigo_rastreio = $_POST['codigo_rastreio'];

$comentario = 'Mudança de status no pedido, pedido ' . $status_rastreio;

if($status_rastreio == 'Enviado') {

    $comentario = 'Seu pedido foi enviado, o código de postagem é ' . $codigo_rastreio;

    if($codigo_rastreio == "") {
    echo "Preencha o código de postagem!";
    exit();
    }
}

$query = $pdo->prepare("UPDATE vendas SET status = '$status_rastreio', rastreio = :rastreio where id = '$id_venda'");

$query->bindValue(":rastreio", $codigo_rastreio);

$query->execute();

$res = $pdo->query("INSERT mensagens SET id_venda = '$id_venda', mensagem = '$comentario', usuario = 'Admin', data = curDate(), hora = curTime()");

echo 'Editado com Sucesso!';

//ENVIAR EMAIL PARA O CLIENTE INFORMANDO DA COMPRA

$query = $pdo->query("SELECT * FROM vendas where id = '$id_venda'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$id_usuario = $res[0]['id_usuario'];

$query = $pdo->query("SELECT * FROM usuarios where id = '$id_usuario'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$email_cliente = $res[0]['email'];

$destinatario = $email_cliente;
$assunto = 'Atualização no Status da Compra - ' . $nome_loja;
$remetente = $email_loja;
$mensagem_email = utf8_decode($comentario);
$cabecalhos = 'From: ' . $remetente;
@mail($destinatario, $assunto, $mensagem_email, $remetente);


?>