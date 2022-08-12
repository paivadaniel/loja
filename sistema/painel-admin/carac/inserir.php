<?php

require_once('../../../conexao.php');

$nomeNovo = $_POST['nome-carac'];
//$imagem = $_POST['imagem-categoria']; //tanto para o upload de imagem quanto para a inserção do caminho da imagem no banco de dados a variável imagem vem de $_FILES['imagem-categoria']['name']

$id = @$_POST['txtid2']; //quando for inserção virá vazio
$nomeAntigo = $_POST['antigoNomeCarac'];

if ($nomeNovo == '') {
  echo 'Preencha a característica';
  exit();
}

//verificar se característica com o mesmo nome já está cadastrada no banco de dados
if ($nomeNovo != $nomeAntigo) {

  $query = $pdo->query("SELECT * FROM carac WHERE nome = '$nomeNovo'");
  $res = $query->fetchAll(PDO::FETCH_ASSOC);
  $total_reg = @count($res);

  if ($total_reg > 0) {
    echo 'Característica já cadastrada em nosso banco de dados.';
    exit();
  }
}

if ($id == '') { //inserção no banco de dados
  $query = $pdo->prepare("INSERT INTO carac (nome) VALUES (:nome)");
} else { //edição no banco de dados

  $query = $pdo->prepare("UPDATE carac SET nome = :nome WHERE id = '$id'");
}

$query->bindValue(':nome', $nomeNovo);

$query->execute();

echo 'Salvo com Sucesso!';
