<?php

@session_start();

if (@$_SESSION['nivel_usuario'] != 'Cliente') {
    echo "<script>window.location='../index.php'</script>";
    exit();
}
