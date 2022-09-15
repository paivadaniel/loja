<?php

require_once('../../../conexao.php');

$id = $_POST['id'];

//apagar imagem da pasta

//apagar do banco de dados
$pdo->query("DELETE FROM blog WHERE id = '$id'");

echo 'Excluído com Sucesso!';