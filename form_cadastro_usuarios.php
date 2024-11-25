<?php

include_once("conexao.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = isset($_REQUEST['nome']) ? $_REQUEST['nome'] : '';
    $email = isset($_REQUEST['email']) ? $_REQUEST['email'] : '';
    $usuario = isset($_REQUEST['usuario']) ? $_REQUEST['usuario'] : '';
    $senha = isset($_REQUEST['senha']) ? $_REQUEST['senha'] : '';
    $telefone = isset($_REQUEST['telefone']) ? $_REQUEST['telefone'] : '';
    $endereco = isset($_REQUEST['endereco']) ? $_REQUEST['endereco'] : '';

    if ($nome && $email && $usuario && $senha && $telefone && $endereco) {
        $senhaCriptografada = password_hash($senha, PASSWORD_DEFAULT);

        $sql = "INSERT INTO usuarios (nome, email, senha, telefone, endereco) 
                VALUES (:nome, :email, :senha, :telefone, :endereco)";

        try {
            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':senha', $senhaCriptografada);
            $stmt->bindParam(':telefone', $telefone);
            $stmt->bindParam(':endereco', $endereco);

            if ($stmt->execute()) {
                echo "<h2>Usuário cadastrado com sucesso</h2>";
            } else {
                echo "<h2>Não foi possível cadastrar o usuário.</h2>";
            }

        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
        }
    } else {
        echo "<h2>Todos os campos são obrigatórios.</h2>";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro - Concept Moda</title>
    <link rel="stylesheet" href="CSS/styles.css">
</head>
<body>
<div class="cadastro">
    <div class="tela_cadastro">
        <form action="" method="post">
            <label>Nome<input type="text" placeholder="Nome completo" name="nome"></label><br>
            <label>Email<input type="email" placeholder="Seu melhor e-mail." name="email"></label><br>
            <label>Usuário<input type="text" placeholder="Usuário" name="usuario"></label><br>
            <label>Senha<input type="password" placeholder="Senha segura" name="senha"></label><br>
            <label>Telefone<input type="tel" placeholder="(xx)xxxxx-xxxx" name="telefone"></label><br>
            <label>Endereço<input type="text" placeholder="Rua, número, bairro" name="endereco"></label><br>
            <a href="?pg=form_login_cliente">Já tem conta?</a>
            <div class="botao_cadastro">
                <input type="submit" value="Cadastrar"><br>
            </div>
        </form>
    </div>
</div>
</body>
</html>
