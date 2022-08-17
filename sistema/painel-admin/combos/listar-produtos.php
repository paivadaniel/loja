<?php

require_once('../../../conexao.php');

@$id_combo = $_POST['txtidCombo'];
$pag = 'combos';

$query = $pdo->query("SELECT * FROM prod_combos where id_combo = '$id_combo'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);

for ($i = 0; $i < count($res); $i++) {
    foreach ($res[$i] as $key => $value) {
    }

    //recupera nome da característica
    $query2 = $pdo->query("SELECT * FROM produtos where id = '$id_prod'");
    $res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
    $nome_produto = $res2[0]['nome'];

    echo "
    <span href='' class='text-dark mr-1'><small>". @$nome_produto . "</small></span>
<a href='#' onClick='deletarProdCombo(". @$res[$i]['id'] .")' title='Excluir Produto do Combo'><small><i class='far fa-trash-alt text-danger'></i></small></a>
<hr>
    
    ";


}
