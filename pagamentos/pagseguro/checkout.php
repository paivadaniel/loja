<?php
header("access-control-allow-origin: https://pagseguro.uol.com.br");
header("Content-Type: text/html; charset=UTF-8", true);
date_default_timezone_set('America/Sao_Paulo');
include_once('../../conexao.php');

session_start();

require_once("PagSeguro.class.php");
$PagSeguro = new PagSeguro();

$id_venda = $_GET['id_venda'];
$pacote = @$_GET['pacote'];




$query = $pdo->query("SELECT * FROM vendas where id = '$id_venda'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$id_usuario = $res[0]['id_usuario'];

$query2 = $pdo->query("SELECT * FROM usuarios where id = '$id_usuario'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
$cpf_usuario = $res2[0]['cpf'];

$query3 = $pdo->query("SELECT * FROM clientes where cpf = '$cpf_usuario'");
$res3 = $query3->fetchAll(PDO::FETCH_ASSOC);
$cpf_usuario = $res3[0]['cpf'];





$query_aluno = "SELECT * from alunos where cpf = '$cpf_aluno' ";
$result_aluno = mysqli_query($conexao, $query_aluno);
$res_aluno = mysqli_fetch_array($result_aluno);
$nome_aluno = $res_aluno['nome'];
$telefone = $res_aluno['telefone'];
$email = $res_aluno['email'];
$cidade = $res_aluno['cidade'];
$estado = $res_aluno['estado'];

if ($telefone == "") {
	$telefone = "(33) 3333-3333";
}



//EFETUAR PAGAMENTO	
$venda = array(
	"codigo" => $id_matricula,
	"valor" => $valor,
	"descricao" => $curso,
	"nome" => $nome_aluno,
	"email" => $email,
	"telefone" => $telefone,
	"rua" => "",
	"numero" => "",
	"bairro" => "",
	"cidade" => "",
	"estado" => "", //2 LETRAS MAIÚSCULAS
	"cep" => "",
	"codigo_pagseguro" => $id_matricula
);

$PagSeguro->executeCheckout($venda, $url_site . "/painel-aluno/painel_aluno.php?acao=cursos");

//----------------------------------------------------------------------------


//RECEBER RETORNO
if (isset($_GET['transaction_id'])) {
	$pagamento = $PagSeguro->getStatusByReference($_GET['codigo']);

	$pagamento->codigo_pagseguro = $_GET['transaction_id'];
	if ($pagamento->status == 3 || $pagamento->status == 4) {
	} else {
		//ATUALIZAR NA BASE DE DADOS
	}
}
