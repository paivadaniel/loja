<?php

require_once('../../../conexao.php');

$titulo_cupom = $_POST['titulo_cupom'];
$valor_cupom = $_POST['valor_cupom'];
$data_cupom = $_POST['data_cupom']; //data limite para uso do cupom, e não a data de hoje

$novoCodigo = $_POST['codigo_cupom'];

$id = @$_POST['txtid2']; //quando for inserção virá vazio
$antigoCodigo = $_POST['antigoCodigo'];

//se o usuário digitar com vírgula, substitui por ponto para passar para o banco de dados
$valor_cupom = str_replace(',', '.', $valor_cupom);

if ($titulo_cupom == '') {
  echo 'Preencha o título do cupom';
  exit();
}

if ($novoCodigo == '') {
  echo 'Preencha o código do cupom';
  exit();
}

if ($valor_cupom == '') {
  echo 'Preencha o valor do cupom';
  exit();
}

if ($data_cupom == '') {
  echo 'Preencha a data de validade do cupom';
  exit();
}

//verificar se cupom com o mesmo código já está cadastrada no banco de dados
if ($novoCodigo != $antigoCodigo) {

  $query = $pdo->query("SELECT * FROM cupons WHERE codigo = '$novoCodigo'");
  $res = $query->fetchAll(PDO::FETCH_ASSOC);
  $total_reg = @count($res);

  if ($total_reg > 0) {
    echo 'Código de cupom já cadastrado em nosso banco de dados.';
    exit();
  }
}

if ($id == '') { //inserção no banco de dados
  $query = $pdo->prepare("INSERT INTO cupons (titulo, codigo, valor, data) VALUES (:titulo, :codigo, :valor, '$data_cupom')");
} else { //edição no banco de dados

  $query = $pdo->prepare("UPDATE cupons SET titulo = :titulo, codigo = :codigo, valor = :valor, data = '$data_cupom' WHERE id = '$id'");
}

$query->bindValue(':titulo', $titulo_cupom);
$query->bindValue(':codigo', $novoCodigo);
$query->bindValue(':valor', $valor_cupom);

$query->execute();

echo 'Salvo com Sucesso!';
