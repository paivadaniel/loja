<?php

//VARIÁVEIS DO SERVIDOR LOCAL
$servidor = 'localhost';
$banco = 'portalead';
$usuario = 'root';
$senha = '';

/*
//VARIÁVEIS DO SERVIDOR HOSPEDADO
$servidor = 'xxx';
$banco = 'xxx';
$usuario = 'xxx';
$senha = 'localhost';
*/

//url sistema
//ao invés de digitar $url_sistema = 'http://localhost/dashboard/www/portal-ead/';, automatiza da seguinte maneira:
$url_sistema = "http://$_SERVER[HTTP_HOST]/"; //se for servidor local, armazena localhost, do contrário, armazena http://hugocursos.com.br, se este for o domínio em que estão hospedados os arquivos
$url = explode("//", $url_sistema);
if($url[1] == 'localhost/'){
	$url_sistema = "http://$_SERVER[HTTP_HOST]/loja/";
}

//VARIÁVEIS GLOBAIS
$nome_loja = 'Lojinha do Daniel'; //esse é o nome padrão, depois o usuário pode mudar o nome do site
$email_loja = 'danielantunespaiva@gmail.com';
$tel_loja = '(15) 3333-3333';
$whatsapp_loja = '(15) 99180-5895';
$whatsapp_loja_link = '5515991805895';
$texto_destaque = 'Frete grátis para compras acima de R$100,00';
$endereco_loja = 'Rua 1, do lado da rua 2, Centro, Sorocaba/SP';

date_default_timezone_set('America/Sao_Paulo');

try {
    //fora a PDO, existem outros tipos de conexões com o banco de dados, como mysqli
    $pdo = new PDO("mysql:dbname=$banco; host=$servidor", "$usuario", "$senha");
} catch (Throwable $th) { //Exception $e não funciona para mim
    echo 'Erro ao conectar ao banco de dados! <br><br>' . $th;
}

?>