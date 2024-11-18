<?php

    include_once("../config.inc.php");

    $id = $_REQUEST['id'];

    $sql = "DELETE FROM contatos WHERE id = $id";

    $query = mysqli_query($conexao,$sql);

    if($query){
        echo "<h2>Mensagem apagada com sucesso.</h2>";
    }else{
        echo "Não foi possível apagar a mensagem.";
    }