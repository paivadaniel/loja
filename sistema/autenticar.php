<?php

require_once('../conexao.php');

@session_start();

$email_login = $_POST['email_login'];
$senha_login = md5($_POST['senha_login']);

if($email_login == '') {
    echo 'Preencha o campo email';
    exit();
}

if($senha_login == '') {
    echo 'Preencha o campo senha';
    exit();
}

$query = $pdo->query("SELECT * FROM usuarios WHERE ((email = '$email_login' OR cpf = '$email_login') AND senha_crip = '$senha_login')");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);

if($total_reg > 0) {

    //alterar o cpf com base no cpf anterior é complicado, por isso, podemos alterar cpf ou qualquer outro dado com base no id, esse é imutável para cada usuário, daí recuperarmos o id
    $_SESSION['id_usuario'] = $res[0]['id'];
    $_SESSION['nome_usuario'] = $res[0]['nome'];
    $_SESSION['email_usuario'] = $res[0]['email'];
    $_SESSION['cpf_usuario'] = $res[0]['cpf'];
    $_SESSION['nivel_usuario'] = $res[0]['nivel'];

    if($_SESSION['nivel_usuario'] == 'Administrador') {
        //outra forma de redirecionar é utilizando o próprio PHP, com a função header, porém, segundo o autor dá problema em alguns servidores
        echo "<script> window.location='painel-admin'</script>";
    } else if ($_SESSION['nivel_usuario']  == 'Cliente') {
        echo "<script> window.location='painel-cliente'</script>";
    }

} else {
    echo "<script>window.alert('Dados incorretos')</script>";
    echo "<script> window.location='index.php'</script>";

}