<?php

require_once('../../conexao.php');

$nome = $_POST['nome-editar-perfil'];
$cpfNovo = $_POST['cpf-editar-perfil'];
$emailNovo = $_POST['email-editar-perfil'];
$senha = $_POST['senha-editar-perfil'];
$confirmar_senha = $_POST['confirmar-senha-editar-perfil'];

$id = $_POST['txtid'];
$cpfAntigo = $_POST['cpfAntigo'];
$emailAntigo = $_POST['emailAntigo'];

if($nome == '') {
    echo 'Preencha o campo nome';
    exit();
}

if($emailNovo == '') {
    echo 'Preencha o campo email';
    exit();
}

if($cpfNovo == '') {
    echo 'Preencha o campo cpf';
    exit();
}

if($senha == '') {
    echo 'Preencha o campo senha';
    exit();
}

if($confirmar_senha == '') {
    echo 'Confirme a senha digitada';
    exit();
}

if($senha != $confirmar_senha) {
    echo 'As senhas digitas não coincidem';
    exit();
}

//verificação de duplicidade de CPF
if($cpfNovo != $cpfAntigo) {

    $query = $pdo->query("SELECT * FROM usuarios WHERE cpf = '$cpfNovo'");
    $res = $query->fetchAll(PDO::FETCH_ASSOC);
    $total_reg = @count($res);

    if($total_reg > 0) {
        echo 'CPF já cadastrado em nosso banco de dados.';
        exit();
    } 
    
    //não pode ter o else abaixo, pois se eu alterar o CPF para um que não conste no banco de dados, e alterar o email para um que conste no banco de dados, ele irá dar update no CPF e exibir a frase Email já cadastrado em nosso banco de dados, isso pois o update ocorre primeiro do que o exit() do email já cadastrado
    /*else { //cpf alterado não existe no banco de dados
        $query = $pdo->prepare("UPDATE usuarios SET cpf = :cpf WHERE id = '$id' and nivel = 'Administrador'");

        $query->bindValue(':cpf', $cpfNovo);
        $query->execute();
    }*/

}

//verificação de duplicidade de email
if($emailNovo != $emailAntigo) {

    $query = $pdo->query("SELECT * FROM usuarios WHERE email = '$emailNovo'");
    $res = $query->fetchAll(PDO::FETCH_ASSOC);
    $total_reg = @count($res);

    if($total_reg > 0) {
        echo 'Email já cadastrado em nosso banco de dados.';
        exit();
    } /*else { //email alterado não existe no banco de dados
        $query = $pdo->prepare("UPDATE usuarios SET email = :email WHERE id = '$id' and nivel = 'Administrador'");

        $query->bindValue(':email', $emailNovo);
        $query->execute();
    }*/

}

//atualiza na tabela usuários
$query = $pdo->prepare("UPDATE usuarios SET nome = :nome, email = :email, cpf = :cpf, senha = :senha, senha_crip = :senha_crip WHERE id = '$id' and nivel = 'Cliente'");

$query->bindValue(':nome', $nome);
$query->bindValue(':email', $emailNovo);
$query->bindValue(':cpf', $cpfNovo);

$query->bindValue(':senha', $senha);
$query->bindValue(':senha_crip', md5($senha));

$query->execute();

//atualiza na tabela clientes
$query = $pdo->prepare("UPDATE clientes SET nome = :nome, email = :email, cpf = :cpf WHERE cpf = '$cpfAntigo'");

$query->bindValue(':nome', $nome);
$query->bindValue(':email', $emailNovo);
$query->bindValue(':cpf', $cpfNovo);

$query->execute();

echo 'Perfil Editado com Sucesso!';

?>