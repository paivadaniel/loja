<?php

require_once('../../../conexao.php');

$id_produto = $_POST['id_produto'];

$query = $pdo->query("SELECT * FROM imagens where id_produto = '$id_produto'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);

echo "<div class='row'>";

for ($i = 0; $i < count($res); $i++) {
    foreach ($res[$i] as $key => $value) {
    }

    echo "<img class='ml-4 mb-2' src='../../img/produtos/detalhes/" . $res[$i]['imagem'] . "' width='70'><a href='#' onClick='deletarImg(" . $res[$i]['id'] . ")'><i class='text-danger fas fa-times ml-1'></i></a>";
}
echo "</div>";
