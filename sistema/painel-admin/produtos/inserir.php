<?php

require_once("../../../conexao.php");

$nome = $_POST['nome'];
$id_cat = $_POST['categoria'];
$id_sub_cat = $_POST['subcategoria'];
$descricao = $_POST['descricao'];
$descricao_longa = $_POST['descricao_longa'];
$valor = $_POST['valor'];
$estoque = $_POST['estoque'];
$tipo_envio = $_POST['tipo_envio'];
$ativo = $_POST['ativo'];
$palavras = $_POST['palavras'];
$peso = $_POST['peso'];
$largura = $_POST['largura'];
$altura = $_POST['altura'];
$comprimento = $_POST['comprimento'];
$modelo = $_POST['modelo'];
$valor_frete = $_POST['valor_frete'];

$valor = str_replace(',', '.', $valor);
$valor_frete = str_replace(',', '.', $valor_frete);
$peso = str_replace(',', '.', $peso);
$largura = str_replace(',', '.', $largura);
$altura = str_replace(',', '.', $altura);
$comprimento = str_replace(',', '.', $comprimento);

$nome_novo = strtolower(preg_replace(
	"[^a-zA-Z0-9-]",
	"-",
	strtr(
		utf8_decode(trim($nome)),
		utf8_decode("áàãâéêíóôõúüñçÁÀÃÂÉÊÍÓÔÕÚÜÑÇ"),
		"aaaaeeiooouuncAAAAEEIOOOUUNC-"
	)
));
$nome_url = preg_replace('/[ -]+/', '-', $nome_novo);

$antigo = $_POST['antigoNomeProduto'];
$id = $_POST['txtid2'];

if ($nome == "") {
	echo 'Preencha o Campo Nome!';
	exit();
}

if ($valor == "") {
	echo 'Preencha o Campo Valor!';
	exit();
}

//verificar se produto com o mesmo nome já está cadastrado no banco de dados
if ($nome != $antigo) {

	$query = $pdo->query("SELECT * FROM produtos WHERE nome = '$nome'");
	$res = $query->fetchAll(PDO::FETCH_ASSOC);
	$total_reg = @count($res);

	if ($total_reg > 0) {
		echo 'Produto já cadastrado em nosso banco de dados.';
		exit();
	}
}

//SCRIPT PARA SUBIR FOTO NO BANCO
$nome_img = preg_replace('/[ -]+/', '-', @$_FILES['imagem']['name']); //isso foi feito para não dar erros em nomes de imagens com espaçamentos, como "camisa social", assim automaticamente envia a imagem para a pasta como "camisa-social", e para o banco de dados como "camisa-social", isso foi visto no mod05 aula12

$caminho = '../../../img/produtos/' . $nome_img;
if (@$_FILES['imagem']['name'] == "") {
	$imagem = "sem-foto.jpg";
} else {

	$imagem = $nome_img;

}

$imagem_temp = @$_FILES['imagem']['tmp_name'];

$ext = pathinfo($imagem, PATHINFO_EXTENSION);
if ($ext == 'png' or $ext == 'jpg' or $ext == 'jpeg' or $ext == 'gif') {
	move_uploaded_file($imagem_temp, $caminho);
} else {
	echo 'Extensão de Imagem não permitida!';
	exit();
}


if ($id == "") {
	$res = $pdo->prepare("INSERT INTO produtos (id_categoria, id_subcategoria, nome, nome_url, descricao, descricao_longa, valor, imagem, estoque, tipo_envio, palavras, ativo, peso, largura, altura, comprimento, modelo, valor_frete, promocao) VALUES (:categoria, :subcategoria, :nome, :nome_url, :descricao, :descricao_longa, :valor, :imagem, :estoque, :tipo_envio, :palavras, :ativo, :peso, :largura, :altura, :comprimento, :modelo, :valor_frete, 'Não')");
	$res->bindValue(":imagem", $imagem);
} else {

	if ($imagem == "sem-foto.jpg") {
		$res = $pdo->prepare("UPDATE produtos SET id_categoria = :categoria, id_subcategoria = :subcategoria, nome = :nome, nome_url = :nome_url, descricao = :descricao, descricao_longa = :descricao_longa, valor = :valor, estoque = :estoque, tipo_envio = :tipo_envio, palavras = :palavras, ativo = :ativo, peso = :peso, largura = :largura, altura = :altura, comprimento = :comprimento, modelo = :modelo, valor_frete = :valor_frete, promocao = 'Não' WHERE id = :id");
	} else {
		$res = $pdo->prepare("UPDATE produtos SET id_categoria = :categoria, id_subcategoria = :subcategoria, nome = :nome, nome_url = :nome_url,descricao = :descricao,descricao_longa = :descricao_longa,valor = :valor,estoque = :estoque,tipo_envio = :tipo_envio,palavras = :palavras,ativo = :ativo,peso = :peso, largura = :largura, altura = :altura, comprimento = :comprimento, modelo = :modelo, valor_frete = :valor_frete, imagem = :imagem, promocao = 'Não' WHERE id = :id");
		$res->bindValue(":imagem", $imagem);
	}

	$res->bindValue(":id", $id);
}

$res->bindValue(":nome", $nome);
$res->bindValue(":nome_url", $nome_url);
$res->bindValue(":categoria", $id_cat);
$res->bindValue(":subcategoria", $id_sub_cat);
$res->bindValue(":descricao", $descricao);
$res->bindValue(":descricao_longa", $descricao_longa);
$res->bindValue(":valor", $valor);
$res->bindValue(":estoque", $estoque);
$res->bindValue(":tipo_envio", $tipo_envio);
$res->bindValue(":palavras", $palavras);
$res->bindValue(":ativo", $ativo);
$res->bindValue(":peso", $peso);
$res->bindValue(":largura", $largura);
$res->bindValue(":altura", $altura);
$res->bindValue(":comprimento", $comprimento);
$res->bindValue(":modelo", $modelo);
$res->bindValue(":valor_frete", $valor_frete);


$res->execute();


echo 'Salvo com Sucesso!';
