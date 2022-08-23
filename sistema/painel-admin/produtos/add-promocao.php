<?php

require_once('../../../conexao.php');

$id_prod = $_POST['id_produto_promocao']; //id do produto, passado em produtos.php com input tipo hidden

$desconto = $_POST['valor_promocao'];
$desconto .= "%";

$ativo_promocao = $_POST['ativo_promocao'];
$data_inicio_promocao = $_POST['data_inicio_promocao'];
$data_final_promocao = $_POST['data_final_promocao'];

$valor_promocao = str_replace(',', '.', $valor_promocao);

$agora = date('Y-m-d');

if($valor_promocao == '') {
    echo 'Insira um valor';
    exit();
}

if($data_inicio_promocao < $agora || $data_final_promocao <$agora) {
    echo 'As datas de início e fim da promoção devem ser maiores ou iguais ao dia de hoje.';
    exit();
}

//verificar se característica já existe para esse produto
$query = $pdo->query("SELECT * FROM promocoes WHERE id_produto = '$id_prod'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);

if ($total_reg == 0) {
    $query = $pdo->prepare("INSERT INTO promocoes (id_produto, valor, data_inicio, data_final, ativo) VALUES ('$id_prod', :valor, '$data_inicio_promocao', '$data_final_promocao', '$ativo_promocao')");
    
    $pdo->query("UPDATE produtos SET promocao = '$ativo_promocao' WHERE id = '$id_prod'");
    //posso inserir uma promoção e colocar ativo_promocao = 'Não', ainda assim tenho que atualizar a tabela de produtos

} else {
    $query = $pdo->prepare("UPDATE promocoes SET valor = :valor, data_inicio = '$data_inicio_promocao', data_final = '$data_final_promocao', ativo = '$ativo_promocao' WHERE id_produto = '$id_prod'");

    $pdo->query("UPDATE produtos SET promocao = '$ativo_promocao' WHERE id = '$id_prod'");

}
$query->bindValue(":valor", "$valor_promocao");
$query->execute();


echo 'Promoção Inserida com Sucesso!';


