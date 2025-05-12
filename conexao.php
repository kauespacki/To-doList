<?php
    if (session_status() === PHP_SESSION_NONE){
        session_start();
    }
    $conn = new mysqli("localhost", "root", "", "to_do_list", 3307);
    if($conn->connect_error){
        die("Erro na conexão ao banco: " . $conn->connect_error);
    }
    if($_SERVER["REQUEST_METHOD"] == "GET"){
        $acao = $_GET["acao"] ?? null;
        if(isset($acao) && $acao == "deletar"){
            excluirUsuario($conn, $_SESSION["id"]);
        }
        if(isset($acao) && $acao == "deletartarefa"){
            if (!isset($_SESSION["id"]) || $_SESSION["id"] === ""){
                header("location: index.php");
                exit;
            }
            $idTarefa = $_GET["id"] ?? null;
            excluirTarefa($conn, $idTarefa);
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
        $q2 = "DELETE FROM tarefas WHERE id_usuario = '$id'";
        $resultado = $conn->query($q);
        $resultado2 = $conn->query($q2);
        if($resultado && $resultado2){
            header("location: logout.php");
            exit;
        } else {
            echo "Erro ao excluir conta.";
        }   
    }

    function excluirTarefa($conn, $idTarefa){
        $q = "DELETE FROM `tarefas` WHERE `tarefas`.`id` = '$idTarefa' AND id_usuario =" . $_SESSION["id"];
        $resultado = $conn->query($q);
        header("location: bem-vindo.php");
        exit;
    }

    function adicionarTarefa($conn, $idUsuario, $descricao){
        $q = "INSERT INTO `tarefas` (`id`, `id_usuario`, `descricao`) VALUES (NULL, '$idUsuario', '$descricao');";
        $resultado = $conn->query($q);
    }

    function atualizarTarefa($conn, $idUsuario, $idTarefa, $descricao){
        $idTarefa = $idTarefa - 1; // no SQL o parametro OFFSET precisa ser -1;
        $q = "SELECT * FROM tarefas
        WHERE id_usuario = '$idUsuario'
        LIMIT 1 OFFSET $idTarefa;";
        $resultado = $conn->query($q);
        if($resultado->num_rows > 0){
            $linha = $resultado->fetch_assoc();
            $idRealTarefa = $linha["id"];
        } else {
            echo "<script>return alert('Erro ao atualizar.')</script>";
        }
        $q2 = "UPDATE `tarefas` SET `descricao` = '$descricao' WHERE `id` = ". $idRealTarefa;
        $resultado2 = $conn->query($q2);
    }
?>