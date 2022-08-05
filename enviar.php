<?php

require_once('config.php');

$destinatario = $email_loja; //variável global em config.php
$assunto = 'Nova Mensagem do Formulário de Contato - '.$nome_loja;

$nome_cliente = $_POST['nome'];
$remetente = $_POST['email'];

$telefone_cliente = $_POST['telefone'];
$mensagem_cliente = $_POST['mensagem'];

if($nome_cliente == "") {
    echo 'Preencha o campo nome';
    exit();
}

if($remetente == "") {
    echo 'Preencha o campo email';
    exit();
}

if($mensagem_cliente == "") {
    echo 'Preencha o campo mensagem';
    exit();
}


// \r\n é quebra de linha, no caso, abaixo utilizamos duas quebras de linha seguidas, seria o mesmo que <br><br>
//utf8_decode é para prevenir erros de acentuação, porém, como visto no curso de portal-ead, muitas vezes utf8_decode gera erros de acentuação, e sem utf8_decode não gera erros de acentuação, portanto, é inútil
$mensagem_email = utf8_decode('Nome: '.$nome_cliente. "\r\n"."\r\n" . 'Telefone: '.$telefone_cliente. "\r\n"."\r\n" . 'Mensagem: ' . "\r\n"."\r\n" .$mensagem_cliente);

$cabecalhos = 'From: '.$remetente;

@mail($destinatario, $assunto, $mensagem_email, $remetente); //o cabecalho já recebe o remetente
//coloca @ para ignorar a mensagem de warning, e então para o if dentro do success (em contatos.php) ser ativado sem cair no else

echo "Enviado com Sucesso!";



?>