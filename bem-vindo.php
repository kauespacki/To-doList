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
    foreach($lista as $indice => $item){
            if($item['descricao'] === "Nenhuma tarefa!"){
                echo $item['descricao'];
                break;
            }
            echo "<li style='display: flex; align-items: center; justify-content: space-between;'>"; 
            echo "<p>" . $indice+1 . ". " . $item['descricao'] . "</p>";
            echo "<a href='conexao.php?acao=deletartarefa&id=" . $item['id'] . "' class='erro'>Excluir</a>";
            echo "</li>";
    }
    echo "</ol>";
?>

<a href="logout.php">Sair</a>
<a href="conexao.php?acao=deletar" onclick="return confirm('Tem certeza?');">Excluir conta</a>
<a href="adicionartarefa.php">Adicionar tarefas</a>
<a href="atualizartarefa.php">Atualizar tarefas</a>
</div>