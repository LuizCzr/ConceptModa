<?php

    include_once("../config.inc.php");

    $codigo = $_REQUEST['codigo'];

    $sql = "DELETE FROM produtos WHERE codigo = $codigo";

    $query = mysqli_query($conexao,$sql);

    if($query){
        echo "<h2>Produto excluído com sucesso.</h2>";
    }else{
        echo "Não foi possível apagar o produto.";
    }