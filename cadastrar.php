<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1 class="titulo">Cadastre-se</h1>
    <form method="post">
        Nome<br><input name="nome" type="text" required>
        <br>
        Usuario<br><input name="usuario" type="text" required>
        <br>
        Senha<br><input name="senha" type="password" required>
        <br>
        Email<br><input name="email" type="text" required>
        <br>
        <input type="submit" value="Cadastrar">
        <a href="index.php">Já tenho cadastro</a>
    </form>
</body>
</html>

<?php
    include "conexao.php";
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $nome = $_POST["nome"];
        $usuario = $_POST["usuario"];
        $senha = $_POST["senha"];
        $email = $_POST["email"];
        if(enviouFormulario($nome, $usuario, $senha, $email)){
            if(cadastrarUsuario($conn, $nome, $usuario, $senha, $email)){
                ##header("location: index.php");
                echo "<script>alert('Cadastro efetuado com sucesso!');
                window.location.href = 'index.php';
                </script>";
                exit;
            }
        }    
    }

    function enviouFormulario($nome, $usuario, $senha, $email){
        if(isset($nome) && $nome !== "" && isset($usuario) && $usuario !== "" && isset($senha) && $senha !== "" && isset($email) && $email !== ""){
            return true;
        } 
        return false;
    }
?>