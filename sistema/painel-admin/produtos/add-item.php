<?php

require_once('../../../conexao.php');

$id_carac_prod = $_POST['id_carac_item_2'];
$nome_item = $_POST['nome_item'];
$valor_item = $_POST['valor_item'];

if($nome_item == '') {
    echo "Digite uma descrição para o item à ser adicionado.";
    exit();
}

//verificar se item já existe para esse produto
$query = $pdo->query("SELECT * FROM carac_itens WHERE id_carac_prod = '$id_carac_prod' and nome_item = '$nome_item'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);

if ($total_reg > 0) {
    echo 'Item já cadastrado para essa característica desse produto.';
    exit();
}

    $pdo->query("INSERT INTO carac_itens (id_carac_prod, nome_item, valor_item) VALUES ('$id_carac_prod', '$nome_item', '$valor_item')");


echo 'Item Adicionado com Sucesso!';
