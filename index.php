<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1 class="titulo">Login</h1>
    <form method="POST" action="">
        Usuário<br><input type="text" name="usuario" required>
        <br>
        Senha<br><input type="password" name="senha" required>
        <br>
        <input type="submit" value="Logar">
        <a href="cadastrar.php">Cadastrar</a>
    </form>
</body>
</html>

<?php
    ## php: precisa ser name ao invés de id no input
    ## isset: garante que existe a chave e não é null
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    session_start();
    if(isset($_SESSION["id"]) && $_SESSION["id"] !== ""){
        header("location: bem-vindo.php");
    }
    include "conexao.php";
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $usuario = $_POST["usuario"] ?? "";
        $senha = $_POST["senha"] ?? "";

        if(formularioEnviado($usuario, $senha)){
            $resultado = usuarioExiste($conn, $usuario, $senha);
            $usuarioExiste = $resultado["existe"] ?? false;
            if($usuarioExiste){
                $nomeUsuario = $resultado["nome"];
                $email = $resultado["email"];
                $id = $resultado["id"];
                $_SESSION["nome"] = $nomeUsuario;
                $_SESSION["usuario"] = $usuario;
                $_SESSION["email"] = $email;
                $_SESSION["id"] = $id;
                header("location: bem-vindo.php");
                exit;
            } else {
                echo "<p class='erro'>Usuário ou senha incorretos.</p>";
            }
        }
    }

    function formularioEnviado($usuario, $senha){
        if(isset($_POST["usuario"]) && $_POST["usuario"] !== "" && isset($_POST["senha"]) && $_POST["senha"] !== ""){
            return true;
        }
        return false;
    }
?>