<?php

require_once('../../../conexao.php');

$id_prod_combo_deletar = $_POST['id_prod_combo_deletar'];

$pdo->query("DELETE FROM prod_combos WHERE id = '$id_prod_combo_deletar'");

echo 'Produto Excluído do Combo com Sucesso!';

?>