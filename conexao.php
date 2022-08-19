<?php

require_once('config.php');

date_default_timezone_set('America/Sao_Paulo'); //passa data e hora para o servidor com fuso horário de São Paulo

try { //tente
    //fora a PDO, existem outros tipos de conexões com o banco de dados, como mysqli
    $pdo = new PDO("mysql:dbname=$banco; host=$servidor; charset=utf8", "$usuario", "$senha");

    //conexão específica (em mysqli, não em PDO) para o backup, pode usar essa classe para o backup sem PDO, pois ela não necessita de entrada de dados, que o PDO é mais eficiente com bindValue para evitar sql injection
    $conn = mysqli_connect($servidor, $usuario, $senha, $banco);


} catch (Throwable $th) { //se a tentativa deu errado, entre aqui. Exception $e não funciona para mim
    echo 'Erro ao conectar ao banco de dados! <br><br>' . $th;
}
