<?php

require_once("../conexao.php");

$id_carrinho = @$_POST['id_carrinho'];

$query = $pdo->query("SELECT * from carac_itens_carrinho WHERE id_carrinho = '$id_carrinho'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);

for ($i = 0; $i < count($res); $i++) {
    foreach ($res[$i] as $key => $value) {
    }

    echo '<span class="mr-2"><i class="fa fa-check text-info"></i> ' . $res[$i]['nome_carac'] . ': ' . $res[$i]['nome_item'] .'</span> <br>';

}
