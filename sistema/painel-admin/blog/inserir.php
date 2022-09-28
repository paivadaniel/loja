<?php

require_once('../../../conexao.php');

@session_start();

$id_autor = $_SESSION['id_usuario'];
$id = $_POST['txtid2'];
$novoTitulo = $_POST['titulo_post'];
$descricao_1 = $_POST['descricao_1'];
$descricao_2 = $_POST['descricao_2'];
$antigoTitulo = $_POST['antigoTitulo'];
$palavras = $_POST['palavras_post'];

//$imagem = $_POST['imagem-categoria']; //tanto para o upload de imagem quanto para a inserção do caminho da imagem no banco de dados a variável imagem vem de $_FILES['imagem-categoria']['name']

//remove caracteres especiais, espaçamentos, adiciona hifen entre os espaçamentos
$tituloNovoCorrigido = strtolower(preg_replace(
  "[^a-zA-Z0-9-]",
  "-",
  strtr(
    utf8_decode(trim($novoTitulo)),
    utf8_decode("áàãâéêíóôõúüñçÁÀÃÂÉÊÍÓÔÕÚÜÑÇ?"), //sinal de interrogação acrescido para não ir para nome_url do post
    "aaaaeeiooouuncAAAAEEIOOOUUNC-"
  )
));
$titulo_url = preg_replace('/[ -]+/', '-', $tituloNovoCorrigido);

if ($novoTitulo == '') {
  echo 'Preencha o campo título';
  exit();
}

//verificar se categoria com o mesmo nome já está cadastrada no banco de dados
if ($novoTitulo != $antigoTitulo) {

  $query = $pdo->query("SELECT * FROM blog WHERE titulo = '$novoTitulo'");
  $res = $query->fetchAll(PDO::FETCH_ASSOC);
  $total_reg = @count($res);

  if ($total_reg > 0) {
    echo 'Título já cadastrado no banco de dados.';
    exit();
  }
}

//SCRIPT PARA SUBIR FOTO NO BANCO
$nome_img = preg_replace('/[ -]+/', '-', @$_FILES['imagem_post']['name']);

$caminho = '../../../img/blog/' . $nome_img;
if (@$_FILES['imagem_post']['name'] == "") {
	$imagem = "sem-foto.jpg";
} else {

	$imagem = $nome_img;

}
$imagem_temp = @$_FILES['imagem_post']['tmp_name'];

$ext = pathinfo($imagem, PATHINFO_EXTENSION); //para evitar inserção de arquivos maliciosos (por exemplo, tipo .exe) por scripts de terceiros, ainda que apenas administradores possam inserir imagem
if ($ext == 'png' or $ext == 'jpg' or $ext == 'jpeg' or $ext == 'gif') {
  move_uploaded_file($imagem_temp, $caminho);
} else {
  echo 'Extensão de Imagem não permitida!';
  exit();
}

if ($id == '') { //inserção no banco de dados
  $query = $pdo->prepare("INSERT INTO blog (id_autor, titulo, titulo_url, descricao_1, descricao_2, palavras, imagem, data) VALUES ('$id_autor', :titulo, :titulo_url, :descricao_1, :descricao_2, :palavras, :imagem, curDate())");
  $query->bindValue(':imagem', $imagem);
} else { //edição no banco de dados

  //código abaixo usado pelo autor pois ao mudar o nome de uma categoria, e não alterar a imagem dela, no script para subir foto, imagem='sem-foto.jpg', e então a imagem é substituida por 'sem-foto.jpg', porém, o código abaixo tem um problema, pois se eu editar e substituir 'sem-foto.jpg' por uma imagem, e depois editar e substituir essa imagem por 'sem-foto.jpg', ele não faz o update de 'sem-foto.jpg' no banco de dados (no caminho da imagem). isso é um problema que dificilmente ocorrerá, mas gera possibilidade de erro, e na minha opinião a lógica do script para subir foto é que deveria ser alterada
  if ($imagem == 'sem-foto.jpg') {
    $query = $pdo->prepare("UPDATE blog SET titulo = :titulo, titulo_url = :titulo_url, descricao_1 = :descricao_1, descricao_2 = :descricao_2, palavras = :palavras WHERE id = '$id'");
  } else {

    $query = $pdo->prepare("UPDATE blog SET titulo = :titulo, titulo_url = :titulo_url, descricao_1 = :descricao_1, descricao_2 = :descricao_2, palavras = :palavras, imagem = :imagem WHERE id = '$id'");
    $query->bindValue(':imagem', $imagem);
  }
}

$query->bindValue(':titulo', $novoTitulo);
$query->bindValue(':titulo_url', $titulo_url);
$query->bindValue(':descricao_1', $descricao_1);
$query->bindValue(':descricao_2', $descricao_2);
$query->bindValue(':palavras', $palavras);

$query->execute();

echo 'Salvo com Sucesso!';
