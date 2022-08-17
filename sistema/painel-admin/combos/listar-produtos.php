<?php

require_once('../../../conexao.php');

$id_combo = $_POST['idtxtCombo'];//id do combo, passado em produtos.php com input tipo hidden

$query = $pdo->query("SELECT * FROM prod_combos where id_combo = '$id_combo'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);

for ($i = 0; $i < count($res); $i++) {
    foreach ($res[$i] as $key => $value) {
    }

    $id_produto = $res[$i]['id_produto'];

    //recupera nome da característica
    $query2 = $pdo->query("SELECT * FROM produtos where id = '$id_produto'");
    $res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
    $nome_produto = $res2[0]['nome'];

    echo"
    <span class='text-dark'><small>". @$nome_produto ."</small></span>
    <a href='#' onclick='deletarProd(". @$res[$i]['id'] .")' class='text-danger mr-1' title='Excluir Produto'><small><i class='far fa-trash-alt'></i></a></small>";

//$res[$i]['id'] é o id da linha de prod_combo, ela que terá que ser deletada, e não id_produto ou id_combo, pois se fossemos deletar o produto, teriam varios id_produto iguais na tabela prod_combos na hora de fazer WHERE id_produto = '$id_produto', e para achar exatamente aquela linha, teríamos que chamar também o id_combo para a página excluir-produto.php, mais fácil ir pela linha do id em prod_combos

}

