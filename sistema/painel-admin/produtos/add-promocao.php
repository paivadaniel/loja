<?php

require_once('../../../conexao.php');

$id_prod = $_POST['id_produto_promocao']; //id do produto, passado em produtos.php com input tipo hidden

$desconto = $_POST['desconto_promocao'];

$query = $pdo->query("SELECT * FROM produtos WHERE id = '$id_prod'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$valor_prod_sem_desconto = $res[0]['valor'];

$valor_promocao = $valor_prod_sem_desconto - ($valor_prod_sem_desconto * ($desconto/100));

$ativo_promocao = $_POST['ativo_promocao'];
$data_inicio_promocao = $_POST['data_inicio_promocao'];
$data_final_promocao = $_POST['data_final_promocao'];

$agora = date('Y-m-d');

if($desconto == '') {
    echo 'Insira um valor de desconto';
    exit();
}

if($data_inicio_promocao < $agora || $data_final_promocao <$agora) {
    echo 'As datas de início e fim da promoção devem ser maiores ou iguais ao dia de hoje.';
    exit();
}

//verificar se promoção já existe para esse produto
$query = $pdo->query("SELECT * FROM promocoes WHERE id_produto = '$id_prod'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);

if ($total_reg == 0) { //se promoção não existir
    $query = $pdo->prepare("INSERT INTO promocoes (id_produto, valor, data_inicio, data_final, ativo, desconto) VALUES ('$id_prod', :valor, '$data_inicio_promocao', '$data_final_promocao', '$ativo_promocao', :desconto)");
    
    $pdo->query("UPDATE produtos SET promocao = '$ativo_promocao' WHERE id = '$id_prod'");
    //posso inserir uma promoção e colocar ativo_promocao = 'Não', ainda assim tenho que atualizar a tabela de produtos

} else {
    $query = $pdo->prepare("UPDATE promocoes SET valor = :valor, data_inicio = '$data_inicio_promocao', data_final = '$data_final_promocao', ativo = '$ativo_promocao', desconto = :desconto WHERE id_produto = '$id_prod'");

    $pdo->query("UPDATE produtos SET promocao = '$ativo_promocao' WHERE id = '$id_prod'");

}
$query->bindValue(":valor", "$valor_promocao");
$query->bindValue(":desconto", "$desconto");

$query->execute();


echo 'Promoção Inserida com Sucesso!';


