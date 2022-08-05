<?php

require_once('config.php');

date_default_timezone_set('America/Sao_Paulo'); //passa data e hora para o servidor com fuso horário de São Paulo

try { //tente
    //fora a PDO, existem outros tipos de conexões com o banco de dados, como mysqli
    $pdo = new PDO("mysql:dbname=$banco; host=$servidor", "$usuario", "$senha");
} catch (Throwable $th) { //se a tentativa deu errado, entre aqui. Exception $e não funciona para mim
    echo 'Erro ao conectar ao banco de dados! <br><br>' . $th;
}

?>