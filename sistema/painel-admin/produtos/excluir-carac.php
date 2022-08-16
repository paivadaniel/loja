<?php

require_once('../../../conexao.php');

$id_carac = $_POST['id_carac_deletar'];

$pdo->query("DELETE FROM carac_prod WHERE id_carac = '$id_carac'");

echo 'Excluído com Sucesso!';

?>