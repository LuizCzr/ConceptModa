<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Concept Moda</title>
    <link rel="stylesheet" href="CSS/styles.css">
</head>
<body>
<?php
    include_once("modelos/topo.php");
    include_once("modelos/menu.php");
    
    if (isset($_SESSION['nome'])) {
        echo "<p>Bem-vindo, " . htmlspecialchars($_SESSION['nome']) . "!</p>";
    }

    if(empty($_SERVER['QUERY_STRING'])){
        $var = "conteudo.php";
        include_once($var);
    } else {
        $pg = $_GET['pg'];
        include_once("$pg.php");
    }

    include_once("modelos/rodape.php");
?>
</body>
</html>
