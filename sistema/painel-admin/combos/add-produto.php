<?php

require_once('../../../conexao.php');

$id_prod = @$_POST['txtidProduto']; //id do produto, passado em combos.php com input tipo hidden
$id_combo = @$_POST['txtidCombo']; //id do combo, passado em combos.php com input tipo hidden

//verificar se característica já existe para esse produto
$query = $pdo->query("SELECT * FROM prod_combos WHERE id_produto = '$id_prod' and id_combo = '$id_combo'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);

if ($total_reg > 0) {
    echo 'Produto já adicionado à este combo.';
    exit();
}

    $pdo->query("INSERT INTO carac_prod (id_produto, id_combo) VALUES ('$id_prod', '$id_combo')");


echo 'Produto Adicionado com Sucesso!';
