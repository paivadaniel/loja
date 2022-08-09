<?php

require_once('../../conexao.php');

$nomeNovo = $_POST['nome-categoria'];
$imagem = $_POST['imagem-categoria'];

$id = @$_POST['txtid2']; //quando for inserção virá vazio
$nomeAntigo = $_POST['antigoNomeCategoria'];

if($nome == '') {
    echo 'Preencha o campo nome';
    exit();
}

//verificar se categoria com o mesmo nome já está cadastrada no banco de dados
if($nomeNovo != $nomeAntigo) { 

    $query = $pdo->query("SELECT * FROM categorias WHERE nome = '$nomeNovo'");
    $res = $query->fetchAll(PDO::FETCH_ASSOC);
    $total_reg = @count($res);

    if($total_reg > 0) {
        echo 'Categoria já cadastrada em nosso banco de dados.';
        exit();
    }
}

//SCRIPT PARA SUBIR FOTO NO BANCO
$caminho = '../../../img/categorias/' .@$_FILES['imagem-categoria']['name'];
if (@$_FILES['imagem-categoria']['name'] == ""){
  $imagem = "sem-foto.jpg";
}else{
  $imagem = @$_FILES['imagem-categoria']['name']; 
}

$imagem_temp = @$_FILES['imagem-categoria']['tmp_name']; 

$ext = pathinfo($imagem, PATHINFO_EXTENSION); //para evitar inserção de arquivos maliciosos (por exemplo, tipo .exe) por scripts de terceiros, ainda que apenas administradores possam inserir imagem
if($ext == 'png' or $ext == 'jpg' or $ext == 'jpeg' or $ext == 'gif'){ 
move_uploaded_file($imagem_temp, $caminho);
}else{
	echo 'Extensão de Imagem não permitida!';
	exit();
}


echo 'Salvo com Sucesso!';
