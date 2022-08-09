<?php

require_once('../conexao.php');

$email_recuperar_senha = $_POST['email-recuperar-senha'];

if ($email_recuperar_senha == '') {
    echo 'Digite o email para o qual a senha deve ser enviada.';
    exit();
} else {
    $query = $pdo->query("SELECT * FROM usuarios WHERE email = '$email_recuperar_senha'");
    $res = $query->fetchAll(PDO::FETCH_ASSOC);
    $total_reg = @count($res);

    if ($total_reg > 0) {

        $senha_cliente = $res[0]['senha'];
        $nome_cliente = $res[0]['nome'];

        $destinatario = $email_recuperar_senha;
        $assunto = 'Recuperação de Senha - ' . $nome_loja;

        $remetente = $email_loja;

        $mensagem_email = utf8_decode('Nome: ' . $nome_cliente . "\r\n" . "\r\n" . 'Senha: ' . $senha_cliente);

        $cabecalhos = 'From: ' . $remetente;

        @mail($destinatario, $assunto, $mensagem_email, $remetente);

        echo 'Senha Enviada para o Email!';

    } else {
        echo 'Email não cadastrado em nosso banco de dados.';
        exit(); //exit() desnecessário, pois abaixo dele não há nenhum código para ser executado
    }
}
