<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start(); // Inicia a sessão apenas se não estiver ativa
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Concept Moda</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <div class="container-header">
        <div class="logo">
            <h1>Concept Moda</h1>
        </div>
        <div class="autenticacao">
            <?php if (isset($_SESSION['usuario']) && !empty($_SESSION['usuario'])): ?>
                <span class="usuario-nome">Olá, 
                    <?php 
                        if (isset($_SESSION['nome']) && !empty($_SESSION['nome'])) {
                            $nome = explode(' ', $_SESSION['nome'])[0]; // Exibe o primeiro nome
                            echo htmlspecialchars($nome); 
                        } else {
                            echo "Usuário"; // Exibe "Usuário" se o nome não estiver na sessão
                        }
                    ?>
                </span>
                <a href="logout.php" class="botao">Sair</a>
            <?php else: ?>
                <a href="?pg=form_login_usuario" class="botao">Login</a>
                <a href="?pg=form_cadastro_usuarios" class="botao">Cadastro</a>
            <?php endif; ?>
        </div>
    </div>
</header>
