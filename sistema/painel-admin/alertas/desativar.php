<?php

require_once('../../../conexao.php');

$id = $_POST['id'];

$pdo->query("UPDATE alertas SET ativo = 'Não' WHERE id = '$id'");

echo 'Alerta Desativado com Sucesso!';