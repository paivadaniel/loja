<?php

require_once('../../../conexao.php');

$nomeNovo = $_POST['nome-subcategoria'];
//$imagem = $_POST['imagem-categoria']; //tanto para o upload de imagem quanto para a inserção do caminho da imagem no banco de dados a variável imagem vem de $_FILES['imagem-categoria']['name']

//remove caracteres especiais, espaçamentos, adiciona hifen entre os espaçamentos
$nomeNovoCorrigido = strtolower(preg_replace(
  "[^a-zA-Z0-9-]",
  "-",
  strtr(
    utf8_decode(trim($nomeNovo)),
    utf8_decode("áàãâéêíóôõúüñçÁÀÃÂÉÊÍÓÔÕÚÜÑÇ"),
    "aaaaeeiooouuncAAAAEEIOOOUUNC-"
  )
));
$nome_url = preg_replace('/[ -]+/', '-', $nomeNovoCorrigido);

$id_categoria = $_POST['categoria'];
$id = @$_POST['txtid2']; //quando for inserção virá vazio
$nomeAntigo = $_POST['antigoNomeSubcategoria'];

if ($nomeNovo == '') {
  echo 'Preencha o campo nome';
  exit();
}

//verificar se categoria com o mesmo nome já está cadastrada no banco de dados
if ($nomeNovo != $nomeAntigo) {

  $query = $pdo->query("SELECT * FROM subcategorias WHERE nome = '$nomeNovo'");
  $res = $query->fetchAll(PDO::FETCH_ASSOC);
  $total_reg = @count($res);

  if ($total_reg > 0) {
    echo 'Subcategoria já cadastrada em nosso banco de dados.';
    exit();
  }
}

//SCRIPT PARA SUBIR FOTO NO BANCO
$nome_img = preg_replace('/[ -]+/', '-', @$_FILES['imagem']['name']);

$caminho = '../../../img/subcategorias/' . $nome_img;
if (@$_FILES['imagem']['name'] == "") {
	$imagem = "sem-foto.jpg";
} else {

	$imagem = $nome_img;

}
$imagem_temp = @$_FILES['imagem-subcategoria']['tmp_name'];

$ext = pathinfo($imagem, PATHINFO_EXTENSION); //para evitar inserção de arquivos maliciosos (por exemplo, tipo .exe) por scripts de terceiros, ainda que apenas administradores possam inserir imagem
if ($ext == 'png' or $ext == 'jpg' or $ext == 'jpeg' or $ext == 'gif') {
  move_uploaded_file($imagem_temp, $caminho);
} else {
  echo 'Extensão de Imagem não permitida!';
  exit();
}

if ($id == '') { //inserção no banco de dados
  $query = $pdo->prepare("INSERT INTO subcategorias (nome, nome_url, imagem, id_categoria) VALUES (:nome, :nome_url, :imagem, '$id_categoria')");
  $query->bindValue(':imagem', $imagem);
} else { //edição no banco de dados

  //código abaixo usado pelo autor pois ao mudar o nome de uma categoria, e não alterar a imagem dela, no script para subir foto, imagem='sem-foto.jpg', e então a imagem é substituida por 'sem-foto.jpg', porém, o código abaixo tem um problema, pois se eu editar e substituir 'sem-foto.jpg' por uma imagem, e depois editar e substituir essa imagem por 'sem-foto.jpg', ele não faz o update de 'sem-foto.jpg' no banco de dados (no caminho da imagem). isso é um problema que dificilmente ocorrerá, mas gera possibilidade de erro, e na minha opinião a lógica do script para subir foto é que deveria ser alterada
  if ($imagem == 'sem-foto.jpg') {
    $query = $pdo->prepare("UPDATE subcategorias SET nome = :nome, nome_url = :nome_url, id_categoria = '$id_categoria' WHERE id = '$id'");
  } else {

    $query = $pdo->prepare("UPDATE subcategorias SET nome = :nome, nome_url = :nome_url, id_categoria = '$id_categoria', imagem = :imagem WHERE id = '$id'");
    $query->bindValue(':imagem', $imagem);
  }
}

$query->bindValue(':nome', $nomeNovo);
$query->bindValue(':nome_url', $nome_url);

$query->execute();

echo 'Salvo com Sucesso!';
