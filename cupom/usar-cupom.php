<?php

require_once('../conexao.php');

$codigo_cupom = $_POST['codigo_cupom'];

$codigo_cupom = str_replace(",", ".", $codigo_cupom);

if($codigo_cupom == "") {
    echo "Insira um valor para o cupom!";
    exit();
}

//data >= curDate() é desnecessário, pois toda vez que o admin acessa a página de cupons (cupons.php) no painel-admin, foi programado para apagar automaticamente os cupons vencidos, 
$query = $pdo->query("SELECT * FROM cupons WHERE codigo = '$codigo_cupom' and data >= curDate()");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);

if($total_reg > 0) { //se existir esse cupom cadastrado no banco de dados

$valor_cupom = $res[0]['valor'];

echo $valor_cupom;

$pdo->query("DELETE FROM cupons WHERE codigo = '$codigo_cupom'");
//autor optou por excluir o cupom após o uso, e dessa forma um cupom só pode ser usado uma única vez, porém eu faria diferente, impossibilitando o uso do cupom para usuário que já o utilizou e permitindo que fosse usado novamente por aqueles que não o utilizaram

} else {
    echo "Código de cupom inválido!";
}