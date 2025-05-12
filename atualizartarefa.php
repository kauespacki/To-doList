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
    <title>Atualizar tarefas</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div>
    <form method="post">
        <h1 class='titulo' style='color: black'>Atualizar tarefas</h1>
        Id<br><input name="idTarefaAtualizar" type="number" required>
        <br>
        Descrição<br><input name="descricao" type="text" required>
        <br>
        <input type="submit" value="Atualizar">
        <a href="logout.php">Sair</a>
        <a href="bem-vindo.php">Ver tarefas</a>
    </form>
</body>
</html>

<?php
    include "conexao.php";
    if($_SERVER["REQUEST_METHOD"] === "POST"){
        $idTarefaAtualizar = $_POST["idTarefaAtualizar"];
        $descricao = $_POST["descricao"];
        atualizarTarefa($conn, $_SESSION["id"], $idTarefaAtualizar, $descricao);
        echo "<script>alert('Tarefa atualizada!')</script>";
    }
?>