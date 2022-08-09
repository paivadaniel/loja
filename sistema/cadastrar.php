<?php

require_once('../conexao.php');

$nome = $_POST['nome'];
$cpf = $_POST['cpf'];
$email_cad = $_POST['email_cad'];
$senha_cad = $_POST['senha_cad'];
$senha_cad_crip = md5($senha_cad);
$confirmar_senha = $_POST['confirmar-senha'];

if($nome == '') {
    echo 'Preencha o campo nome';
    exit();
}

if($email_cad == '') {
    echo 'Preencha o campo email';
    exit();
}

if($cpf == '') {
    echo 'Preencha o campo cpf';
    exit();
}

if($senha_cad == '') {
    echo 'Preencha o campo senha';
    exit();
}

if($confirmar_senha == '') {
    echo 'Confirme a senha digitada';
    exit();
}

if($senha_cad != $confirmar_senha) {
    echo 'As senhas digitas não coincidem';
    exit();
}

//INSERÇÃO TABELA DE USUÁRIOS

//verificar se o email digitado já está cadastrado na tabela de usuários
$query = $pdo->query("SELECT * FROM usuarios WHERE email = '$email_cad'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);

if($total_reg > 0) {
    echo 'Email já cadastrado! Escolha outro.';
    exit();
}

//verificar se o cpf digitado já está cadastrado na tabela de usuários
$query = $pdo->query("SELECT * FROM usuarios WHERE cpf = '$cpf'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);

if($total_reg > 0) {
    echo 'CPF já cadastrado! Escolha outro.';
    exit();
}

//cadastrar cliente na tabela usuários
$query = $pdo->prepare("INSERT INTO usuarios (nome, cpf, email, senha, senha_crip, nivel, data_cad) values (:nome, :cpf, :email, :senha, :senha_crip, 'Cliente', curDate())");

$query->bindValue(":nome", "$nome");
$query->bindValue(":cpf", "$cpf");
$query->bindValue(":email", "$email_cad");
$query->bindValue(":senha", "$senha_cad");
$query->bindValue(":senha_crip", "$senha_cad_crip");

$query->execute();

echo 'Cadastro efetuado com Sucesso!';

//INSERÇÃO TABELA DE CLIENTES

$query = $pdo->prepare("INSERT INTO clientes (nome, cpf, email) values (:nome, :cpf, :email)");

$query->bindValue(":nome", "$nome");
$query->bindValue(":cpf", "$cpf");
$query->bindValue(":email", "$email_cad");

$query->execute();

//INSERÇÃO TABELA DE EMAILS

//verificar se o email digitado já está cadastrado na tabela de emails
$query = $pdo->query("SELECT * FROM emails WHERE email = '$email_cad'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);

if($total_reg == 0) {

//cadastrar email do cliente na lista de emails
$query = $pdo->prepare("INSERT INTO emails (nome, email, ativo) values (:nome, :email, 'Sim')");

$query->bindValue(":nome", "$nome");
$query->bindValue(":email", "$email_cad");

$query->execute();

}
