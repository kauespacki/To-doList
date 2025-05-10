<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To Do List</title>
</head>
<body>
    <link rel="stylesheet" href="style.css">
    <h1>To Do List</h1>
    <a href="logout.php">Sair</a>
    <a href="conexao.php?acao=deletar" onclick="return confirm('Tem certeza?');">Excluir conta</a>
</body>
</html>

<?php
    session_start();
    include "todolist.php";
    $usuario = $_SESSION["usuario"];
    $nome = $_SESSION["nome"];
    $email = $_SESSION["email"] ?? "Não possui";
    if(!isset($usuario) || $usuario === ""){
        header("location: index.php");
    }
    
    echo "<h1>Bem vindo $nome!</h1>";
    $lista = listarTarefas($_SESSION["id"]);
    foreach($lista as $item){
        echo "<li>$item</li>";
    }
?>