<?php

include_once("conexao.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nome = trim($_POST['nome']);
    $email = trim($_POST['email']);
    $usuario = trim($_POST['usuario']);
    $senha = $_POST['senha'];
    $telefone = trim($_POST['telefone']);
    $endereco = trim($_POST['endereco']);

    if (empty($nome) || empty($email) || empty($usuario) || empty($senha) || empty($telefone) || empty($endereco)) {
        $erro = "Todos os campos são obrigatórios.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erro = "E-mail inválido.";
    } elseif (!preg_match('/^\(\d{2}\)\d{5}-\d{4}$/', $telefone)) {
        $erro = "Telefone inválido. O formato correto é (xx)xxxxx-xxxx.";
    } else {
        $senhaCriptografada = password_hash($senha, PASSWORD_DEFAULT);

        $sql = "INSERT INTO usuarios (nome, email, usuario, senha, telefone, endereco) 
                VALUES (:nome, :email, :usuario, :senha, :telefone, :endereco)";

        try {
            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':usuario', $usuario);
            $stmt->bindParam(':senha', $senhaCriptografada);
            $stmt->bindParam(':telefone', $telefone);
            $stmt->bindParam(':endereco', $endereco);

            if ($stmt->execute()) {
                header("Location: ?pg=form_login_usuario");
                exit;
            } else {
                $erro = "Não foi possível cadastrar o usuário. Tente novamente.";
            }

        } catch (PDOException $e) {
            $erro = "Erro: " . $e->getMessage();
        }
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
        <h1>Cadastro de Usuário</h1>
        <form action="" method="post">
            <label>Nome
                <input type="text" placeholder="Nome completo" name="nome" value="<?php echo isset($nome) ? htmlspecialchars($nome) : ''; ?>">
            </label><br>

            <label>Email
                <input type="email" placeholder="Seu melhor e-mail." name="email" value="<?php echo isset($email) ? htmlspecialchars($email) : ''; ?>">
            </label><br>

            <label>Usuário
                <input type="text" placeholder="Usuário" name="usuario" value="<?php echo isset($usuario) ? htmlspecialchars($usuario) : ''; ?>">
            </label><br>

            <label>Senha
                <input type="password" placeholder="Senha segura" name="senha">
            </label><br>

            <label>Telefone
                <input type="tel" placeholder="(xx)xxxxx-xxxx" name="telefone" value="<?php echo isset($telefone) ? htmlspecialchars($telefone) : ''; ?>">
            </label><br>

            <label>Endereço
                <input type="text" placeholder="Rua, número, bairro" name="endereco" value="<?php echo isset($endereco) ? htmlspecialchars($endereco) : ''; ?>">
            </label><br>

            <a href="?pg=form_login_usuario">Já tem conta?</a><br>

            <div class="botao_cadastro">
                <input type="submit" value="Cadastrar"><br>
            </div>
        </form>

        <?php
        if (isset($erro)) {
            echo "<p style='color: red;'>$erro</p>";
        }
        ?>
    </div>
</div>
</body>
</html>
