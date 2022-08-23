<?php

//VARIÁVEIS DO SERVIDOR LOCAL
$servidor = 'localhost';
$banco = 'loja';
$usuario = 'root'; //para quem usa xampp é root
$senha = ''; //para quem usa xampp é vazia

/*
//VARIÁVEIS DO SERVIDOR HOSPEDADO
$servidor = 'xxx';
$banco = 'xxx';
$usuario = 'xxx';
$senha = 'localhost';
*/

//url sistema
//ao invés de digitar $url_sistema = 'http://localhost/dashboard/www/portal-ead/';, automatiza da seguinte maneira:
//$url_loja = "http://$_SERVER[HTTP_HOST]/"; //se for servidor local, armazena localhost, do contrário, armazena http://hugocursos.com.br, se este for o domínio em que estão hospedados os arquivos
//$url = explode("//", $url_sistema);
//if($url[1] == 'localhost/'){
	//$url_loja = "http://$_SERVER[HTTP_HOST]/loja/";
//}

$url_loja = 'http://localhost/dashboard/www/loja/';

//VARIÁVEIS GLOBAIS
$nome_loja = 'Lojinha do Daniel'; //esse é o nome padrão, depois o usuário pode mudar o nome do site
$email_loja = 'danielantunespaiva@gmail.com';
$tel_loja = '(15) 3333-3333';
$whatsapp_loja = '(15) 99180-5895';
$whatsapp_loja_link = '5515991805895';
$texto_destaque = 'Frete grátis para compras acima de R$100,00';
$endereco_loja = 'Rua 1, do lado da rua 2, Centro, Sorocaba/SP';

//VARIÁVEIS DO SITE
$itens_por_pagina = 3;

?>