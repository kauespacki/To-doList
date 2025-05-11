<?php
    session_start();
    include "todolist.php";
    $usuario = $_SESSION["usuario"];
    $nome = $_SESSION["nome"];
    $email = $_SESSION["email"] ?? "Não possui";
    if(!isset($usuario) || $usuario === ""){
        header("location: index.php");
    }
    echo "<h1 class='titulo'>Bem vindo $nome!</h1>";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To Do List</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
    <h1 class='titulo' style='color: black'>To Do List</h1>
</body>
</html>

<?php
    include "conexao.php";
    $lista = listarTarefas($conn, $_SESSION["id"]);
    echo "<ol>";
    foreach($lista as $item){
            echo "<li id='itemTarefa'>" . $item['descricao'] . "</li>";
    }
    echo "</ol>";
?>

<a href="logout.php">Sair</a>
<a href="conexao.php?acao=deletar" onclick="return confirm('Tem certeza?');">Excluir conta</a>
</div>