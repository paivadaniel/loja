<?php

require_once('../../../conexao.php');

$id_venda = $_POST['id_venda'];

//apagar imagem da pasta

//apagar da tabela vendas
$pdo->query("DELETE FROM vendas WHERE id = '$id_venda'");

//apagar da tabela carrinho
$query = $pdo->query("SELECT * FROM carrinho where id_venda = '$id_venda'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);

for ($i=0; $i < count($res); $i++) { 
    foreach ($res[$i] as $key => $value) {
}

$pdo->query("DELETE from carrinho WHERE id_venda = '$id'");

}

echo 'Excluído com Sucesso!';
