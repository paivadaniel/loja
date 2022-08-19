<?php

require_once('../../../conexao.php');

$id = $_POST['id'];

$pdo->query("UPDATE promocoes_banner SET ativo = 'Não' WHERE id = '$id'");

echo 'Promoção Desativada com Sucesso!';