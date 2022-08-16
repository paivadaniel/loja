<?php

require_once('../../../conexao.php');

@$id_carac_item_2 = $_POST['id_carac_item_2'];

$query = $pdo->query("SELECT * FROM carac_itens where id_carac_prod = '$id_carac_item_2'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);

echo "<div class='ml-2'>";

for ($i = 0; $i < count($res); $i++) {
    foreach ($res[$i] as $key => $value) {
    }


    echo "<span class='mb-2'><small><small><small><i class='text-secondary fas fa-check mr-1'></i></small></small></small>".$res[$i]['nome_item']."<a title='Deletar Item' href='#' onClick='deletarItem(". $res[$i]['id'] .")'><small><small><i class='text-danger fas fa-times ml-1'></i></small></small></a></span><br>";


}
echo "</div>";
