<?php

    include_once("../config.inc.php");

    $nome = $_REQUEST['nome'];
    $categoria = $_REQUEST['categoria'];
    $marca = $_REQUEST['marca'];
    $preco = $_REQUEST['preco'];

    $sql = "INSERT INTO produtos
    (nome, categoria, marca, preco) 
    VALUES 
    ('$nome','$categoria','$marca','$preco')";

    $query = mysqli_query($conexao,$sql);

    if($query){
        echo "<h2> Produto Cadastrado com sucesso.</h2>";
    }else{
        echo "<h2> Não foi possível cadastrar o produto.</h2>";
    }

    mysqli_close($conexao);