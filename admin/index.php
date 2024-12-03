<?php

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Admin</title>
    <link rel="stylesheet" href="CSS/stylesadmin.css">
</head>
<body>
<h1>Painel Admin</h1>

<a href="?pg=lista_msg">Lista de Mensagens </a> | 
<a href="?pg=lista_produtos">Produtos </a> | 

<?php
    if (empty($_SERVER['QUERY_STRING'])) {
        $var = "conteudo.php";
        echo "<h2>Página inicial</h2>";
    } else {
        $pg = $_GET['pg'];
        include_once("$pg.php");
    }
?>
</body>
</html>
