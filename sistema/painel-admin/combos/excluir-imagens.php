<?php

require_once('../../../conexao.php');

$id_foto = $_POST['id_foto'];

$pdo->query("DELETE FROM imagens WHERE id = '$id_foto'");

echo 'Excluído com Sucesso!';

?>