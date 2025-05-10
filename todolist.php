<?php
    if(session_status() === PHP_SESSION_NONE){
        session_start();
    }
    function listarTarefas($id){
        return ["1 - Andar", "2 - Comer"];
    }
?>