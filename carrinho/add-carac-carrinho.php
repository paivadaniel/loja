<?php

require_once('../conexao.php');

$salvar;
$id_carac_itens = 0;

$id_carrinho = $_POST['id_carrinho_carrinho']; //não precisa do id_usuario pois o id do carrinho já está vinculado ao usuário

for ($i = 0; $i < 3; $i++) {
    if (isset($_POST[$i]) and $_POST[$i] == "") {
        echo 'Registro não salvo!';
        $salvar = 'Não';
    }
}

for ($i = 0; $i < 3; $i++) {
    if (isset($_POST[$i]) and $_POST[$i] != "") { //se existir e for diferente de nulo
        $id_carac_itens = $_POST[$i];
        $salvar = 'Sim';
    }
}

$query2 = $pdo->query("SELECT * from carac_itens WHERE id = '$id_carac_itens'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
$id_carac_prod = @$res2[0]['id_carac_prod'];
$nome_item_carac = @$res2[0]['nome_item'];

//se mudar de Selecionar Tamanho para P, e de Selecionar Cor para Azul, e depois voltar a deixar esses valores nulos, ou seja, alterar novamente de P para Selecionar Tamanho e de Azul para Selecionar Cor, vai dar problema pois $id_carac_itens não vai mais existir, e daí todas as outras variáveis, como id_carac_prod e nome_item_carac também não vão existir, por isso acrescentei o arroba, além disso teve que acrescentar $id_carac_itens = 0 no início dessa página

$query3 = $pdo->query("SELECT * from carac_prod WHERE id = '$id_carac_prod'");
$res3 = $query3->fetchAll(PDO::FETCH_ASSOC);
$id_carac = @$res3[0]['id_carac'];

$query4 = $pdo->query("SELECT * from carac WHERE id = '$id_carac'");
$res4 = $query4->fetchAll(PDO::FETCH_ASSOC);
$nome_carac = @$res4[0]['nome'];

$query5 = $pdo->query("SELECT * from carac_itens_carrinho WHERE id_carrinho = '$id_carrinho' and id_carac = '$id_carac'");
$res5 = $query5->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res5);

if ($total_reg == 0) { //se for inserção

    if ($salvar == 'Sim') {
        $pdo->query("INSERT INTO carac_itens_carrinho SET id_carrinho = '$id_carrinho', id_carac = '$id_carac', nome_carac = '$nome_carac', nome_item = '$nome_item_carac'");

        echo "Característica Inserida com Sucesso!";
    }
} else { //se for edição, ou seja, aquele registro já estiver no banco de dados

    
        $pdo->query("UPDATE carac_itens_carrinho SET nome_item = '$nome_item_carac' WHERE id_carrinho = '$id_carrinho' and id_carac = '$id_carac'");

        echo "Característica Inserida com Sucesso!";
    
}

/*ERRO_ALGORITMO
1. quando muda de cor amarelo, azul ou vermelho (ou outra que for) para Selecionar Cor, não atualiza o banco
2. quando escolho um tamanho, depois altero um tamanho, e antes de escolher a numeração, escolho uma cor, estraga o algoritmo
depois de escolher a cor, pois não escolhe uma numeração e nem pode alterar o tamanho

*/
