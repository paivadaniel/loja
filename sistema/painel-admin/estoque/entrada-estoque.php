<?php

require_once('../../../conexao.php');

$quantidade_pedido = $_POST['quantidade_pedido'];

$id_produto = @$_POST['txtid2'];

if ($quantidade_pedido == '') {
  echo 'Preencha a quantidade para fazer o pedido';
  exit();
}

if ($quantidade_pedido <= 0) { //se for número negativo ou zero
  echo 'A quantia a ser adquirida deve ser um número maior que zero';
  exit();

}

$query = $pdo->query("SELECT * FROM produtos WHERE id = '$id_produto'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$estoque_atual = $res[0]['estoque'];

$novoEstoque = $estoque_atual + $quantidade_pedido;

$pdo->query("UPDATE produtos SET estoque = '$novoEstoque' WHERE id = '$id_produto'");

echo 'Pedido Feito com Sucesso!';
