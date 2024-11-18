<h1>Painel Admin</h1>
<!-- Menu -->
<?php
/*
    include_once "sessao.php";

    if (logado()) {
        // Usuário está logado
        echo "<p>Bem-vindo <b>$_SESSION[usuario]</b>!</p>";
    } else {
        header("Location: form_login.php");
        exit();
    }
*/
?>
<a href="?pg=lista_msg">Lista de Mensagens </a> | 
<a href="?pg=lista_produtos">Produtos </a> |


<?php

    if(empty($_SERVER['QUERY_STRING'])){
        $var = "conteudo.php";
        echo "<h2>Página inicial</h2>";
        //include_once($var);
    }else{
        $pg = $_GET['pg'];
        include_once("$pg.php");
    }