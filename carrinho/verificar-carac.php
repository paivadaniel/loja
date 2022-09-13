<?php

require_once("../conexao.php");
@session_start();
$id_usuario = @$_SESSION['id_usuario'];

$query = $pdo->query("SELECT * from carrinho where id_usuario = '$id_usuario' and id_venda = 0 order by id asc"); //id_venda = 0 pois a venda ainda não ocorreu
$res = $query->fetchAll(PDO::FETCH_ASSOC);

//combos não têm características a adicionar, portanto, não necessitam de verificação, apenas produtos

for ($i = 0; $i < count($res); $i++) {
    foreach ($res[$i] as $key => $value) {
    }

    $id_produto = $res[$i]['id_produto'];
    $id_carrinho = $res[$i]['id'];
    $combo = $res[$i]['combo'];

    if ($combo != 'Sim') { //se for produto

        //verifica se o produto tem característica a adicionar
        $query_c = $pdo->query("SELECT * from carac_prod WHERE id_prod = '$id_produto'");
        $res_c = $query_c->fetchAll(PDO::FETCH_ASSOC);
        $total_prod_carac = @count($res_c); //total de características do produto

        if ($total_prod_carac > 0) { //isto é, se o produto tiver características a adicionar

            $query2 = $pdo->query("SELECT * from carac_itens_carrinho WHERE id_carrinho = '$id_carrinho'");
            $res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
            $total_carac = @count($res2); //total de características adicionadas

            if ($total_carac == 0) {
                /*ao invés de total_carac == 0, o mais é correto é //$total_carac < $total_prod_carac
            pois para cada característica possível de selecionar, o produto tem que ter uma característica selecionada, portanto, para ir para o checkou, total_carac (características selecionadas) deve ser igual a total_prod_carac (características possíveis de selecionar)
            */
                echo 'Selecione as Características dos Produtos!';
                exit();
            }
        }
    }
}
