<?php

require_once('../../../conexao.php');

$id_produto = $_POST['id_produto'];

//SCRIPT PARA SUBIR FOTO NO BANCO
$caminho = '../../../img/produtos/detalhes/' . @$_FILES['img-produto']['name'];
if (@$_FILES['img-produto']['name'] == "") {
    $imagem = "sem-foto.jpg";
} else {
    $imagem = @$_FILES['img-produto']['name'];
}

$imagem_temp = @$_FILES['img-produto']['tmp_name'];

$ext = pathinfo($imagem, PATHINFO_EXTENSION); //para evitar inserção de arquivos maliciosos (por exemplo, tipo .exe) por scripts de terceiros, ainda que apenas administradores possam inserir imagem
if ($ext == 'png' or $ext == 'jpg' or $ext == 'jpeg' or $ext == 'gif') {
    move_uploaded_file($imagem_temp, $caminho);
} else {
    echo 'Extensão de Imagem não permitida!';
    exit();
}

//apenas para produtos já inseridos é possível adicionar imagens secundárias, ou seja, isso não pode ser feito na modal de inserir produto, lá adiciona-se apenas a imagem principal

$pdo->query("INSERT INTO imagens (id_produto, imagem) VALUES ('$id_produto', '$imagem')");

echo 'Salvo com Sucesso!';
