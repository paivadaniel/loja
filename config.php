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

//CONFIGURAÇÕES DO FRETE DOS CORREIOS
$cep_origem = '18015-000';

/*
1 - Formato caixa/pacote
2 - Formato rolo/prisma
3 - Envelope
*/
$formato_frete = 1;

$comprimento_caixa = '30'; //em cm
$largura_caixa = '20'; //em cm
$altura_caixa = '20'; //em cm
$diametro_caixa = '25'; //em cm

/*
Indica se a encomenda será entregue com o serviço adicional mão própria.
Valores possíveis: S ou N (S – Sim, N – Não)
*/
$mao_propria = 'N';

//valor_declarado, 1 para sim e 0 para não
$valor_declarado = 0;

//aviso_recebimento, S para sim e N para não
$aviso_recebimento = 'N';

/*
40010 SEDEX Varejo
40215 SEDEX 10 Varejo
41106 PAC Varejo
*/

//VARIÁVEIS DO PAGSEGURO

$email_pagseguro = "contato@hugocursos.com.br";
$token_sandbox_pagseguro = "1FB4D7860EA9491BA7AB4A9D9336C275"; //sandbox é modo de teste
$token_oficial_pagseguro = "3301d2e3-f6e6-43bc-9e92-1d18d48c4b1d066a495846d48c42291ec69bc46ca0b4514a-a856-4f96-8da6-1767c89d7850"; //modo de produção, modo real

//VARIAVEIS PARA O CUPOM
$total_cartoes_troca_cupom = 15; //total de cartões para o cliente trocar pelo cumpom de desconto
$valor_cupom_cartao = 20; //valor do desconto para quando o cliente completar x cupons (colocar o valor aqui inteiro)
$dias_uso_cupom = 7;

?>