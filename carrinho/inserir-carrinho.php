<?php

require_once('../conexao.php');
@session_start();

$id_produto = $_POST['id_produto'];
$id_cliente = @$_SESSION['id_usuario'];
$combo = $_POST['combo'];


$pdo->query("INSERT INTO carrinho SET id_produto = '$id_produto', id_usuario = '$id_cliente', id_venda = 0, quantidade = 1, data = curDate(), combo = '$combo'");
//INSERT INTO carrinho (id_produto, id_usuario) VALUES ('$id_produto', '$id_cliente');
echo "Produto Inserido no Carrinho!";


?>