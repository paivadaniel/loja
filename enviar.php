<?php

require_once('conexao.php');

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

//CAPTURAR EMAIL DO CONTATO PARA O BANCO DE DADOS

//verifica se o email já está cadastrado na lista
//quando ativo a query abaixo está dando erro

$query =$pdo->query("SELECT * FROM emails WHERE email = '$remetente'");

/*pode executar com prepare também, porém, é desnecessário nesse caso
$query =$pdo->prepare("SELECT * FROM emails WHERE email = '$remetente'");
$query->execute();
*/

$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);

echo "Enviado com Sucesso!";

if($total_reg == 0) {//se o email não estiver cadastrado na lista

    //$query =$pdo->prepare("INSERT INTO emails SET email = :remetente");

    $query = $pdo->prepare("INSERT INTO emails (nome, email, ativo) values (:nome_cliente, :remetente, 'Sim')");

    $query->bindValue(":nome_cliente", "$nome_cliente");
    $query->bindValue(":remetente", "$remetente");

    $query->execute();

}


?>