<?php

require_once('../../../conexao.php');

$nomeNovo = $_POST['nome-tipo-envio'];
//$imagem = $_POST['imagem-categoria']; //tanto para o upload de imagem quanto para a inserção do caminho da imagem no banco de dados a variável imagem vem de $_FILES['imagem-categoria']['name']

$id = @$_POST['txtid2']; //quando for inserção virá vazio
$nomeAntigo = $_POST['antigoNomeTipoEnvios'];

if ($nomeNovo == '') {
  echo 'Preencha o tipo do envio';
  exit();
}

//verificar se categoria com o mesmo nome já está cadastrada no banco de dados
if ($nomeNovo != $nomeAntigo) {

  $query = $pdo->query("SELECT * FROM tipo_envios WHERE tipo = '$nomeNovo'");
  $res = $query->fetchAll(PDO::FETCH_ASSOC);
  $total_reg = @count($res);

  if ($total_reg > 0) {
    echo 'Tipo de envio já cadastrado em nosso banco de dados.';
    exit();
  }
}

if ($id == '') { //inserção no banco de dados
  $query = $pdo->prepare("INSERT INTO tipo_envios (tipo) VALUES (:tipo)");
} else { //edição no banco de dados

  $query = $pdo->prepare("UPDATE tipo_envios SET tipo = :tipo WHERE id = '$id'");
}

$query->bindValue(':tipo', $nomeNovo);

$query->execute();

echo 'Salvo com Sucesso!';
