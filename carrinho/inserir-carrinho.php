<?php

require_once('../conexao.php');
@session_start();

$id_produto = $_POST['id_produto'];
$id_cliente = @$_SESSION['id_usuario'];
$combo = @$_POST['combo']; //recebe Sim (se for combo) ou Não (se for produto)

if (@$_POST['quantidade'] != null and @$_POST['quantidade'] != "") {
    $quantidade = @$_POST['quantidade'];
} else {
    $quantidade = 1;
}

//minha versão

for ($i = 0; $i < 3; $i++) {

    if (@$_POST[$i] == '0') {
        echo "Selecione todas as características";
        exit();
    } else if (@$_POST[$i] != null and @$_POST[$i] != "" and @$_POST[$i] != '0') {
        $tem_carac = 'Sim';
    }
}

/* versão do autor

//se $_POST['tem_carac'] == "Sim" vem vem de um input tipo hidden em produto.php, a outra opção é adicionar o item ao carrinho pela modal, aberta ao clicar no item de carrinho, na imagem do produto em páginas como index.php e produtos.php


if (@$_POST['tem_carac'] != null and @$_POST['tem_carac'] != "") {

  $tem_carac = 'Sim';

    for ($i = 0; $i < 3; $i++) {

        if (@$_POST[$i] == '0') {
            echo "Selecione todas as características";
            exit();
        } 
    }
//}
   
*/


$pdo->query("INSERT INTO carrinho SET id_produto = '$id_produto', id_usuario = '$id_cliente', id_venda = 0, quantidade = '$quantidade', data = curDate(), combo = '$combo'");
//INSERT INTO carrinho (id_produto, id_usuario) VALUES ('$id_produto', '$id_cliente');

//o INSERT acima cria mais uma linha na tabela carrinho, e portanto, é criado um id para essa linha, o código a seguir recupera o id que acabou de ser criado

$id_carrinho = $pdo->lastInsertId();

//dados para recuperar valores e inserir as características dos itens do carrinho na tabela carac_itens_carrinho
//APENAS PARA ADIÇÕES AO CARRINHO FEITAS DIRETAMENTE NA PÁGINA DO PRODUTO, CASO O PRODUTO FOR ADICIONADO AO CARRINHO (POR EXEMPLO COM O VISITANTE NA INDEX.PHP), A ROTINA PARA INSERÇÃO DAS CARACTERÍSTICAS É OUTRA
//SÓ ENTRA AQUI SE TIVER CARACTERÍSTICA PARA ADICIONAR E TER $tem_carac == "Sim" (se tem_carac = Sim, vem de produto.php)
for ($i2 = 0; $i2 < 3; $i2++) {
    if (@$tem_carac == 'Sim' and @$_POST[$i2] != "") { //se tem carac="Sim" vem de produto.php, porém, o item tem que ter característica diferente de nula

        $id_carac_itens = $_POST[$i2];

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

        $pdo->query("INSERT INTO carac_itens_carrinho SET id_carrinho = '$id_carrinho', id_carac = '$id_carac', nome_carac = '$nome_carac', nome_item = '$nome_item_carac'");
    }
}

echo "Produto Inserido no Carrinho!";
