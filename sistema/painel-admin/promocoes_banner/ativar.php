<?php

require_once('../../../conexao.php');

$id = $_POST['id'];

$query = $pdo->query("SELECT * FROM promocoes_banner WHERE ativo = 'Sim'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);

if ($total_reg >= 2 ) {
    echo 'Apenas dois promoções podem estar ativas por vez, desative uma para ativar outra.';
    exit();
}

$pdo->query("UPDATE promocoes_banner SET ativo = 'Sim' WHERE id = '$id'");

echo 'Promoção Ativada com Sucesso!';