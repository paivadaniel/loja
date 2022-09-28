<?php

include("classCorreios.php");
include("../conexao.php");

//$CepOrigem=filter_input(INPUT_POST,'CepOrigem',FILTER_SANITIZE_SPECIAL_CHARS);
$CepOrigem = $cep_origem; //configurado em ../config.php

//$CepDestino=filter_input(INPUT_POST,'CepDestino',FILTER_SANITIZE_SPECIAL_CHARS);
$CepDestino=$_POST['cep2']; //cep2 está em checkout.php

if($CepDestino == "") {
    echo "<span><small>Preencha o CEP de destino!</small></span>";
    exit();
}

//$Peso=filter_input(INPUT_POST,'Peso',FILTER_SANITIZE_SPECIAL_CHARS);
$Peso = $_POST['total_peso']; //em kg
$nome_produto = $_POST['nome_produto'];

//aqui pega o peso total da compra, mas dessa forma, alguns produtos cadastrados com tipo de envio 1, ou seja, enviados pelo correios, podem ir sem peso, basta que um deles tenha peso para que total_peso seja maior que zero, isso está errado
if(@$Peso == 0 || @$Peso == "" || @$Peso == null){
	echo "<script language='javascript'> window.alert('O produto " . $nome_produto . " está cadastrado sem peso!') </script>";
	exit();
}

//$Formato=filter_input(INPUT_POST,'Formato',FILTER_SANITIZE_SPECIAL_CHARS);
$Formato = $formato_frete; //configurado em ../config.php

//$Comprimento=filter_input(INPUT_POST,'Comprimento',FILTER_SANITIZE_SPECIAL_CHARS);
//$Altura=filter_input(INPUT_POST,'Altura',FILTER_SANITIZE_SPECIAL_CHARS);
//$Largura=filter_input(INPUT_POST,'Largura',FILTER_SANITIZE_SPECIAL_CHARS);
//$Diametro=filter_input(INPUT_POST,'Diametro',FILTER_SANITIZE_SPECIAL_CHARS);
$Comprimento = $comprimento_caixa;
$Altura = $altura_caixa;
$Largura = $largura_caixa;
$Diametro = $diametro_caixa;

//$MaoPropria=filter_input(INPUT_POST,'MaoPropria',FILTER_SANITIZE_SPECIAL_CHARS);
$MaoPropria = $mao_propria;

//$ValorDeclarado=filter_input(INPUT_POST,'ValorDeclarado',FILTER_SANITIZE_SPECIAL_CHARS);
$ValorDeclarado = $valor_declarado;

//$AvisoRecebimento=filter_input(INPUT_POST,'AvisoRecebimento',FILTER_SANITIZE_SPECIAL_CHARS);
$AvisoRecebimento=$aviso_recebimento;

//$Codigo=filter_input(INPUT_POST,'Codigo',FILTER_SANITIZE_SPECIAL_CHARS);
$Codigo=$_POST['codigo_servico_correios']; //codigo_servico_correios está em checkout.php

$Correios=new ClassCorreios();
$Correios->pesquisaPrecoPrazo($CepOrigem,$CepDestino,$Peso,$Formato,$Comprimento,$Altura,$Largura,$MaoPropria,$ValorDeclarado,$AvisoRecebimento,$Codigo,$Diametro);
