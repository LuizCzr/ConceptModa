<?php

    include_once("../config.inc.php");

    $codigo = $_REQUEST['codigo'];
    $nome = $_REQUEST['nome'];
    $categoria = $_REQUEST['categoria'];
    $marca = $_REQUEST['marca'];
    $preco = $_REQUEST['preco'];

    $sql = "UPDATE produtos SET
    nome = '$nome', categoria = '$categoria', marca = '$marca', preco = '$preco' 
    WHERE codigo = $codigo";

    $query = mysqli_query($conexao,$sql);

    if($query){
        echo "<h2> Produto alterado com sucesso.</h2>";
    }else{
        echo "<h2> Não foi possível alterar o produto.</h2>";
    }

    mysqli_close($conexao);