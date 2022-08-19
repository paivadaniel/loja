<?php

require_once('../../conexao.php');

$assunto_email = $_POST['assunto_email'];
$mensagem_email = $_POST['mensagem_email'];

/*
echo 'teste ='. $mensagem_email;
exit();
*/

$link_email = $_POST['link_email'];

if ($assunto_email == '') {
    echo 'Preencha o assunto do email!';
    exit();
}

if ($mensagem_email == '') {
    echo 'Preencha a mensagem do email!';
    exit();
}

$query = $pdo->query("SELECT * FROM emails WHERE ativo = 'Sim'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);

for ($i = 0; $i < count($res); $i++) {
    foreach ($res[$i] as $key => $value) {}

    $to = $res[$i]['email'];
    $nome_cliente = $res[$i]['nome'];
    $subject = "$assunto_email";
    $url_descadastrar = $url_loja . 'descadastrar.php';
    $message = "

				Olá $nome_cliente, <br>
				$mensagem_email

				<br><br> <i> <a title='$link_email' href='$link_email' target='_blank'>Clique aqui </a> para ir para o nosso site!!</i><br><br>

				<a title='$url_loja' href='$url_loja' target='_blank'>$url_loja</a>

				<br><br><br>
				WhatsApp -> <a href='http://api.whatsapp.com/send?1=pt_BR&phone=$whatsapp_loja_link' alt='$whatsapp_loja' target='_blank'><i class='fab fa-whatsapp'></i>$whatsapp_loja</a>

				<br><br><br>
       <i> Caso não queira mais receber nossos emails <a href='$url_descadastrar' target='_blank'> clique aqui </a> para se descadastrar!</i> <br><br>

				";


    $remetente = $email_loja;
    $headers = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=utf-8;' . "\r\n";

    if ($to != $remetente) {
        $headers .= "From: " . $remetente;
    }

    mail($to, $subject, $message, $headers);
}

echo 'Email Marketing Enviado com Sucesso!';
