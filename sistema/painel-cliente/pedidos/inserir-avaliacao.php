<?php

require_once('../../../conexao.php');

@session_start();
$id_usuario = $_SESSION['id_usuario'];

$id_produto_avaliacao = $_POST['id_produto_avaliacao'];
$nota_avaliacao = $_POST['nota_avaliacao'];
$comentario_avaliacao = $_POST['comentario_avaliacao'];
//$combo_avaliacao = $_POST['combo_avaliacao'];
//ideal é fazer a validação se o comentário para o produto já foi feito, vendo se é combo, pois id_produto pode ser o mesmo para produto e combo, para isso tem que chamar combo no argumento da função avaliar, em pedidos/listar-produtos.php, e atribuir o valor combo para o input combo_avaliacao na modal-avaliar em pedidos.php


$query = $pdo->query("SELECT * FROM avaliacoes WHERE id_produto = '$id_produto_avaliacao' and id_usuario = '$id_usuario'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$linhas = @count($res);

if($linhas > 0) { //usuário já fez uma compra antes desse mesmo produto e já o avaliou da outra vez, é permitido apenas uma única avaliação de um usuário para um mesmo produto
    $data_avaliacao = $res[0]['data'];
    $data_avaliacao_formatada = implode('/', array_reverse(explode('-', $data_avaliacao)));

    echo 'Você já avaliou esse produto em '. $data_avaliacao_formatada .'!';
    exit();
}

$query = $pdo->prepare("INSERT INTO avaliacoes (id_produto, id_usuario, texto, nota, data) VALUES ('$id_produto_avaliacao', '$id_usuario', :texto, '$nota_avaliacao', curDate())");

$query->bindValue(":texto", $comentario_avaliacao);
$query->execute();

echo 'Avaliado com Sucesso!';

//ENVIAR EMAIL PARA O ADMIN INFORMANDO DA AVALIAÇÃO
$destinatario = $email_loja;
$assunto = 'Nova Avaliação de Produto - ' . $nome_loja;
$remetente = $email_loja;
$mensagem_email = utf8_decode($comentario_avaliacao);
$cabecalhos = 'From: ' . $remetente;
@mail($destinatario, $assunto, $mensagem_email, $cabecalhos);