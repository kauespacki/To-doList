<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    if(session_status() === PHP_SESSION_NONE){
        session_start();
    }
    function listarTarefas($conn, $id){
        $q = "SELECT * FROM tarefas WHERE id_usuario = '$id'";
        $resultado = $conn->query($q);
        if($resultado->num_rows > 0){
            return $resultado->fetch_all(MYSQLI_ASSOC);
        } else {
            return [["descricao"=>"Nenhuma tarefa!"]];
        }
    }
?>