<?php

require_once('../../../conexao.php');

$id = $_POST['txtid2'];
$tituloNovo = $_POST['titulo_promocao_banner'];
$link = $_POST['link_promocao_banner'];

$antigoTitulo = $_POST['antigoTitulo'];

if ($tituloNovo == '') {
  echo 'Preencha o campo título';
  exit();
}

if ($link == '') {
  echo 'Preencha o campo link';
  exit();
}

//verificar se categoria com o mesmo nome já está cadastrada no banco de dados
if ($tituloNovo != $antigoTitulo) {

  $query = $pdo->query("SELECT * FROM promocoes_banner WHERE titulo = '$tituloNovo'");
  $res = $query->fetchAll(PDO::FETCH_ASSOC);
  $total_reg = @count($res);

  if ($total_reg > 0) {
    echo 'Título de promoção já cadastrado em nosso banco de dados, escolha outro.';
    exit();
  }
}

//SCRIPT PARA SUBIR FOTO NO BANCO
$caminho = '../../../img/promocoes/' . @$_FILES['imagem_promocao_banner']['name'];
if (@$_FILES['imagem_promocao_banner']['name'] == "") {
  $imagem = "sem-foto.jpg";
} else {
  $imagem = @$_FILES['imagem_promocao_banner']['name'];
}

$imagem_temp = @$_FILES['imagem_promocao_banner']['tmp_name'];

$ext = pathinfo($imagem, PATHINFO_EXTENSION); //para evitar inserção de arquivos maliciosos (por exemplo, tipo .exe) por scripts de terceiros, ainda que apenas administradores possam inserir imagem
if ($ext == 'png' or $ext == 'jpg' or $ext == 'jpeg' or $ext == 'gif') {
  move_uploaded_file($imagem_temp, $caminho);
} else {
  echo 'Extensão de Imagem não permitida!';
  exit();
}

if ($id == '') { //inserção no banco de dados
  $query = $pdo->prepare("INSERT INTO promocoes_banner (titulo, link, imagem, ativo) VALUES (:titulo, :link, :imagem, 'Não')");
  $query->bindValue(':imagem', $imagem);
} else { //edição no banco de dados

  //código abaixo usado pelo autor pois ao mudar o nome de uma categoria, e não alterar a imagem dela, no script para subir foto, imagem='sem-foto.jpg', e então a imagem é substituida por 'sem-foto.jpg', porém, o código abaixo tem um problema, pois se eu editar e substituir 'sem-foto.jpg' por uma imagem, e depois editar e substituir essa imagem por 'sem-foto.jpg', ele não faz o update de 'sem-foto.jpg' no banco de dados (no caminho da imagem). isso é um problema que dificilmente ocorrerá, mas gera possibilidade de erro, e na minha opinião a lógica do script para subir foto é que deveria ser alterada
  if ($imagem == 'sem-foto.jpg') {
    $query = $pdo->prepare("UPDATE promocoes_banner SET titulo = :titulo, link = :link WHERE id = '$id'");
  } else {

    $query = $pdo->prepare("UPDATE promocoes_banner SET titulo = :titulo, link = :link, imagem = :imagem WHERE id = '$id'");
    $query->bindValue(':imagem', $imagem);
  }
}

$query->bindValue(':titulo', $tituloNovo);
$query->bindValue(':link', $link);

$query->execute();

echo 'Promoção Salva com Sucesso!';
