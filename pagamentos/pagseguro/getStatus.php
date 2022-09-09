<?php
	require_once("PagSeguro.class.php");

	//captura o status da compra passado em pagseguro/checkout.php e com base na referência dele pode devolver algo
	//autor não usou esse arquivo, e sim o trecho de código no final de pagseguro/checkout.php
	if(isset($_GET['reference'])){
		$PagSeguro = new PagSeguro();
		$P = $PagSeguro->getStatusByReference($_GET['reference']);
		//echo $PagSeguro->getStatusText($P->status);
		echo $P;
		
	}else{
	    echo "Parâmetro \"reference\" não informado!";
	}

?>