<?php

require_once('../../../conexao.php');

$id = $_POST['id'];

$query = $pdo->query("SELECT * FROM alertas WHERE ativo = 'Sim'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);

if ($total_reg >= 1 ) {
    echo 'Apenas uma mensagem de alerta pode estar ativa por vez, desative a outra.';
    exit();
}

$pdo->query("UPDATE alertas SET ativo = 'Sim' WHERE id = '$id'");

echo 'Alerta Ativado com Sucesso!';