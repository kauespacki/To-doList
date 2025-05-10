<?php
    if (session_status() === PHP_SESSION_NONE){
        session_start();
    }
    $conn = new mysqli("localhost", "root", "", "to_do_list");
    if($conn->connect_error){
        die("Erro na conexão ao banco: " . $conn->connect_error);
    }
    if($_SERVER["REQUEST_METHOD"] == "GET"){
        $acao = $_GET["acao"] ?? null;
        if(isset($acao) && $acao == "deletar"){
            excluirUsuario($conn, $_SESSION["id"]);
        }
    }

    function usuarioExiste($conn, $usuario, $senha){
        $q = "SELECT * FROM usuarios WHERE usuario = '$usuario' AND senha = '$senha'";
        $resultado = $conn->query($q);
    
        if ($resultado->num_rows > 0) {
            $resultadoUsuario = $resultado->fetch_assoc();
            return [
                "existe" => true,
                "id" => $resultadoUsuario["id"],
                "nome" => $resultadoUsuario["nome"],
                "email" => $resultadoUsuario["email"]
            ];
        } else {
            return false;
        }
    }

    function cadastrarUsuario($conn, $nome, $usuario, $senha, $email){
        try {
            $q = "INSERT INTO `usuarios` (`id`, `nome`, `usuario`, `email`, `senha`) VALUES (NULL, '$nome', '$usuario', '$email', '$senha');";
            $resultado = $conn->query($q);
            if($resultado === TRUE){
                return true;
            }
            return false;
        } catch(Exception $e){
            echo "<p class='erro'>Erro: " . $e->getMessage() . "</p>";
        }
        
    }

    function excluirUsuario($conn, $id){
        $q = "DELETE FROM usuarios WHERE id = '$id'";
        echo "$id";
        $resultado = $conn->query($q);
        if($resultado){
            header("location: logout.php");
            exit;
        } else {
            echo "Erro ao excluir conta.";
        }
        
    }
    
?>