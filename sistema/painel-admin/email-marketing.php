<?php

require_once('../../conexao.php');

$assunto_email = $_POST['assunto_email'];
$mensagem_email = $_POST['mensagem_email'];
$inicio = 0;
$final = $enviar_total_emails; //definida em config.php

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

//salvar na tabela envios_email
$agora = date('Y-m-d H:i:s');
$nova_hora = date('Y-m-d H:i:s', strtotime('+'.$intervalo_envio_emails.' minute', strtotime($agora))); //data de agora e data daqui 70 minutos

$query = $pdo->query("UPDATE envios_email SET data = '$nova_hora', final = '$final', assunto = '$assunto_email', mensagem = '$mensagem_email', link = '$link_email' where id = 1");

$query = $pdo->query("SELECT * FROM emails WHERE ativo = 'Sim' order by id limit $final");
$res = $query->fetchAll(PDO::FETCH_ASSOC);

$url_nova = $url_loja . $link_email;

for ($i = 0; $i < count($res); $i++) {
    foreach ($res[$i] as $key => $value) {}

    $to = $res[$i]['email'];
    echo $to;

    $nome_cliente = $res[$i]['nome'];
    $subject = "$assunto_email";
    $url_descadastrar = $url_loja . 'descadastrar.php';
    $message = "

				Olá $nome_cliente, <br>
				$mensagem_email

				<br><br> <i> <a title='$url_nova' href='$url_nova' target='_blank'>Clique aqui </a> para ver em nosso site !!</i> <br><br>

				<a title='$url_nova' href='$url_nova' target='_blank'>$url_nova</a>

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

    //ENVIAR EMAIL PARA O ADMINISTRADOR INFORMANDO DO ANDAMENTO DA CAMPANHA DE EMAIL MARKETING
    $destinatario = $email_loja;
    $assunto = 'Campanha Email Marketing - ' . $nome_loja;
    $remetente = $email_loja;
    $mensagem_email = utf8_decode('Email enviado até o email de número '.$final);
    $cabecalhos = 'From: ' . $remetente;
    @mail($destinatario, $assunto, $mensagem_email, $cabecalhos);

echo 'Email Marketing Enviado com Sucesso!';
