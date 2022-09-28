<?php
include_once('conexao.php');

//atualiza automaticamente o arquivo para ver se a hora atual é maior que a hora programada para o próximo envio de email
echo "<meta HTTP-EQUIV='refresh' CONTENT='1200;URL=script-enviar.php'>"; //dá refresh na página a cada 1200 segundos (20 minutos)

$agora = date('Y-m-d H:i:s');

//PEGAR TOTAL DE EMAILS DO BANCO
$query = $pdo->query("SELECT * FROM emails WHERE ativo = 'Sim'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_emails = @count($res);

$query = $pdo->query("SELECT * FROM envios_email WHERE id = 1"); //aqui tem um while que fechava só no final de tudo, tem que corrigir
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$data = $res[0]["data"];
$final = $res[0]["final"];
$assunto_email = $res[0]["assunto"];
$mensagem_email = $res[0]["mensagem"];
$link_email = $res[0]["link"];

if ($final == 0) {
    //se final for zero, não há lista de emails para disparar, e assim, não faz nada
    echo 'Não tem mais emails pendentes, todos já foram enviados!';

} else {

    if ($agora >= $data) { //se a hora atual for maior que a hora programada para o próximo envio de emails, continua a enviar emails

        //VER SE JÁ PASSOU TODA A LISTA DE EMAILS

        if ($final >= ($total_emails)) { //final recebe 0 pois chegou no final da lista de emails a enviar
            $query = $pdo->query("UPDATE envios_email SET data = '$agora', final = '0', assunto = '$assunto_email', mensagem = '$mensagem_email', link = '$link_email' where id = 1");
            exit();
        }

        //se não chegou no final ainda, o próximo início será a partir do último final
        $inicio = $final;
        $final_novo = $enviar_total_emails + $final;

        //APÓS ENVIAR O EMAIL É PRECISO SALVAR A HORA NA TABELA DE ENVIOS
        $nova_hora = date('Y-m-d H:i:s', strtotime('+' . $intervalo_envio_emails . 'minute', strtotime($agora)));

        $query = $pdo->query("UPDATE envios_email SET data = '$nova_hora', final = '$final_novo', assunto = '$assunto_email', mensagem = '$mensagem_email', link = '$link_email' where id = 1");

        $url_s = $url_loja; //url do site, por exemplo http://minhaloja.com/
        $url_nova = $url_loja . $link_email; //url do link que virá no email, por exemplo http://minhaloja.com/link-do-email
        $url_descadastrar = $url_loja . 'descadastrar.php';

        //DISPARAR EMAIL PARA OS CLIENTES DE HORA EM HORA //$intervalo_envio_emails em config.php define o tempo de intervalo entre os disparos de emails
        $query_emails = $pdo->query("SELECT * from emails where ativo = 'Sim' and (id > '$inicio' and id <= '$final_novo')");
        $res_emails = $query_emails->fetchAll(PDO::FETCH_ASSOC);

        for ($i = 0; $i < count($res_emails); $i++) { //esse for tem que fechar
            foreach ($res_emails[$i] as $key => $value) {
            }

            $nome_cliente_email = $res_emails[$i]['nome'];
            $cliente_email = $res_emails[$i]['email'];
            $id_email = $res_emails[$i]['id'];

            $to = $cliente_email;
            $subject = "$assunto_email";

            $message = "

				Olá $nome_cliente_email, <br><br>

				$mensagem_email

				<br><br> <i> <a title='$url_nova' href='$url_nova' target='_blank'>Clique aqui </a> para ver em nosso site !!</i> <br><br>

				<a title='$url_nova' href='$url_nova' target='_blank'>$url_nova</a>
				
				<br><br><br>
				WhatsApp -> <a href='http://api.whatsapp.com/send?1=pt_BR&phone=$whatsapp_loja_link' alt='$whatsapp_loja' target='_blank'><i class='fab fa-whatsapp'></i>$whatsapp_loja</a>

				<br><br><br>
       <i> Caso não queira mais receber nossos emails <a href='$url_descadastrar' target='_blank'> clique aqui </a> para se descadastrar!</i> <br><br>

				";

            $dest = $email_loja;
            $headers = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=utf-8;' . "\r\n";

            if ($to != $dest) {
                $headers .= "From: " . $dest;
            }

            mail($to, $subject, $message, $headers);
            
            //para fins de teste
            //echo $to;
            //echo $subject;
            //echo $message;

        }

        //ENVIAR EMAIL PARA O ADMINISTRADOR INFORMANDO DO ANDAMENTO DA CAMPANHA DE EMAIL MARKETING
        $destinatario = $email_loja;
        $assunto = 'Disparo Email Inicio $inicio e Final $final_novo';
        $remetente = $email_loja;
        $mensagem_email = utf8_decode($mensagem_email);
        $cabecalhos = 'From: ' . $remetente;
        @mail($destinatario, $assunto, $mensagem_email, $cabecalhos);
    }
}
