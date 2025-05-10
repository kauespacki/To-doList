<?php
    session_start();
    $usuario = $_SESSION["usuario"];
    $nome = $_SESSION["nome"];
    $email = $_SESSION["email"] ?? "Não possui";
    if(!isset($usuario) || $usuario === ""){
        header("location: index.php");
    }
    
    echo "<h1>Bem vindo $nome!</h1>";
?>

<link rel="stylesheet" href="style.css">
<a href="logout.php">Sair</a>
<a href="conexao.php?acao=deletar" onclick="return confirm('Tem certeza?');">Excluir conta</a>