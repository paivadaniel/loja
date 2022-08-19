<?php

require_once('conexao.php');

$email_descadastrar = $_POST['email_descadastrar'];

if ($email_descadastrar == '') {
    echo 'Digite o email que quer descadastrar.';
    exit();
} else {
    $query = $pdo->query("SELECT * FROM emails WHERE email = '$email_descadastrar'");
    $res = $query->fetchAll(PDO::FETCH_ASSOC);
    $total_reg = @count($res);

    if ($total_reg > 0) { //se tiver esse email cadastrado na lista de emails

        $pdo->query("UPDATE emails SET ativo = 'Não' WHERE email = '$email_descadastrar'");
        echo 'Descadastrado da Lista com Sucesso!';

    } else {
        echo 'Email não cadastrado em nosso banco de dados.';
        exit(); //exit() desnecessário, pois abaixo dele não há nenhum código para ser executado
    }
}
