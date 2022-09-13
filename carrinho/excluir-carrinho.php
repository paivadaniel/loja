<?php

require_once("../conexao.php");
@session_start();

$id = $_POST['id']; //id do carrinho

$query = $pdo->query("SELECT * from carrinho where id = '$id'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$combo = $res[0]['combo'];
$id_produto = $res[0]['id_produto'];

if ($combo != 'Sim') { //se for produto

    $query_c = $pdo->query("SELECT * from carac_prod WHERE id_prod = '$id_produto'");
    $res_c = $query_c->fetchAll(PDO::FETCH_ASSOC);
    $total_prod_carac = @count($res_c);

    if ($total_prod_carac > 0) { //isto é, se o produto tiver características a adicionar

        /* para mim o SELECT abaixo é desnecessário, e bastava apenas:
            $pdo->query("DELETE FROM carac_itens_carrinho where id_carrinho = '$id'");

            ou seja, podia remover o SELECT, e o FOR, já que a linha acima apagaria todas as linhas com id_carrinho = $id

            porém, como minha atribuição de característica está com problema, não consigo testar
        */
        $query2 = $pdo->query("SELECT * from carac_itens_carrinho WHERE id_carrinho = '$id'");
        $res2 = $query2->fetchAll(PDO::FETCH_ASSOC);

        for ($i2 = 0; $i2 < count($res2); $i2++) {
            foreach ($res2[$i2] as $key => $value) {
            }
            $pdo->query("DELETE FROM carac_itens_carrinho where id_carrinho = '$id'");
        }
    }
}

$pdo->query("DELETE FROM carrinho where id = '$id'");

echo "Excluído com Sucesso!";
