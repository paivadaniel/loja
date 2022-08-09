<?php

@session_start(); //abre a sessão caso ela não exista, para evitar erro
session_destroy();

echo "<script> window.location='index.php'</script>";

?>