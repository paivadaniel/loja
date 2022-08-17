<?php

require_once('../../../conexao.php');

$id_combo = $_POST['idtxtCombo'];//id do combo, passado em produtos.php com input tipo hidden

$id_prod = @$_POST['idtxtProduto']; //id do produto, passado em produtos.php com input tipo hidden

//verificar se produto já existe nesse combo
$query = $pdo->query("SELECT * FROM prod_combos WHERE id_produto = '$id_prod' and id_combo = '$id_combo'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);

if ($total_reg > 0) {
    echo 'Produto já adicionado à esse combo.';
    exit();
}

    $pdo->query("INSERT INTO prod_combos (id_produto, id_combo) VALUES ('$id_prod', '$id_combo')");

echo 'Produto Adicionado ao Combo com Sucesso!';
