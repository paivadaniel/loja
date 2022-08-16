<?php

require_once('../../../conexao.php');

$id_item = $_POST['id_item_carac_deletar'];

$pdo->query("DELETE FROM carac_itens WHERE id = '$id_item'");

echo 'Excluído com Sucesso!';

?>