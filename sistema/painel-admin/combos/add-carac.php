<?php

require_once('../../../conexao.php');

$id_carac = $_POST['id_carac'];

$id_prod = @$_POST['id_prod_carac']; //id do produto, passado em produtos.php com input tipo hidden

//verificar se característica já existe para esse produto
$query = $pdo->query("SELECT * FROM carac_prod WHERE id_prod = '$id_prod' and id_carac = '$id_carac'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);

if ($total_reg > 0) {
    echo 'Característica já cadastrada para esse produto.';
    exit();
}

    $pdo->query("INSERT INTO carac_prod (id_prod, id_carac) VALUES ('$id_prod', '$id_carac')");


echo 'Característica Adicionada com Sucesso!';
