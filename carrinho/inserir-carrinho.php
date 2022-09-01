<?php

require_once('../conexao.php');
@session_start();

$id_produto = $_POST['id_produto'];
$id_cliente = @$_SESSION['id_usuario'];
$combo = $_POST['combo']; //recebe Sim (se for combo) ou Não (se for produto)


if (@$_POST['quantidade'] != null and @$_POST['quantidade'] != "") {
    $quantidade = @$_POST['quantidade'];
} else {
    $quantidade = 1;
}

$pdo->query("INSERT INTO carrinho SET id_produto = '$id_produto', id_usuario = '$id_cliente', id_venda = 0, quantidade = '$quantidade', data = curDate(), combo = '$combo'");
//INSERT INTO carrinho (id_produto, id_usuario) VALUES ('$id_produto', '$id_cliente');
echo "Produto Inserido no Carrinho!";
