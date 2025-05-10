<?php
    session_start(); ## inicia a sessão atual do servidor
    session_unset(); ## apaga as variaveis
    session_destroy(); ## limpa a sessão
    header("location: index.php");
    exit;
?>