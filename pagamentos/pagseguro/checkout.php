<?php
header("access-control-allow-origin: https://pagseguro.uol.com.br");
header("Content-Type: text/html; charset=UTF-8", true);
date_default_timezone_set('America/Sao_Paulo');
include_once('../../conexao.php');

session_start();

require_once("PagSeguro.class.php");
$PagSeguro = new PagSeguro();

$id_venda = @$_GET['codigo'];

$query = $pdo->query("SELECT * FROM vendas where id = '$id_venda'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$id_usuario = $res[0]['id_usuario'];
$valor_venda = $res[0]['total'];

$query2 = $pdo->query("SELECT * FROM usuarios where id = '$id_usuario'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
$cpf_usuario = $res2[0]['cpf'];

$query3 = $pdo->query("SELECT * FROM clientes where cpf = '$cpf_usuario'");
$res3 = $query3->fetchAll(PDO::FETCH_ASSOC);
$nome = $res3[0]['nome'];
$telefone = $res3[0]['telefone'];
$email = $res3[0]['email'];

//para não dar problema no pagSeguro, se o telefone não tiver sido preenchido, preenchemos ele com um número qualquer
if($telefone == "") {
	$telefone = "(33) 3333-3333";
}

//EFETUAR PAGAMENTO	
$venda = array(
	"codigo" => $id_venda,
	"valor" => $valor_venda,
	"descricao" => "Compra - ". $nome_loja,
	"nome" => $nome,
	"email" => $email,
	"telefone" => $telefone,
	"rua" => "",
	"numero" => "",
	"bairro" => "",
	"cidade" => "",
	"estado" => "", //2 LETRAS MAIÚSCULAS
	"cep" => "",
	"codigo_pagseguro" => $id_venda //esse codigo identifica posteriormente se o pagamento foi aprovado
);

$PagSeguro->executeCheckout($venda, $url_loja . "sistema/painel-cliente/index.php?pag=pedidos");

//----------------------------------------------------------------------------


//RECEBER RETORNO
if (isset($_GET['transaction_id'])) {
	$pagamento = $PagSeguro->getStatusByReference($_GET['codigo']);

	$pagamento->codigo_pagseguro = $_GET['transaction_id'];
	if ($pagamento->status == 3 || $pagamento->status == 4) { //id de transação 3 (pago) ou 4 (disponível) são ids de transação aprovada, esses ids estão definidos em PagSeguro.class.php
	} else {
		//ATUALIZAR NA BASE DE DADOS
	}
}
