<?php
include_once("conexao.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = trim($_POST['nome']);
    $email = trim($_POST['email']);
    $assunto = trim($_POST['assunto']);
    $mensagem = trim($_POST['mensagem']);

    if (empty($nome) || empty($email) || empty($mensagem)) {
        $erro = "Todos os campos são obrigatórios.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erro = "O e-mail informado não é válido.";
    } else {
        try {
            $sql = "INSERT INTO mensagens_contato (nome, email, assunto, mensagem) 
                    VALUES (:nome, :email, :assunto, :mensagem)";
            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':assunto', $assunto);
            $stmt->bindParam(':mensagem', $mensagem);

            if ($stmt->execute()) {
                $sucesso = "Mensagem enviada com sucesso. Obrigado pelo seu contato!";
            } else {
                $erro = "Não foi possível enviar a mensagem. Tente novamente.";
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
    <title>Fale Conosco! - Concept Moda</title>
    <link rel="stylesheet" href="CSS/styles.css">
</head>
<body>
    <div class="faleconosco">
        <div class="tela_faleconosco">
            <h3>Entre em contato conosco!</h3><br>

            <?php if (isset($sucesso)): ?>
                <h2 style="color: green;"><?php echo htmlspecialchars($sucesso); ?></h2>
            <?php elseif (isset($erro)): ?>
                <h2 style="color: red;"><?php echo htmlspecialchars($erro); ?></h2>
            <?php endif; ?>

            <form action="" method="post">
                <label for="nome">Nome:</label>
                <input type="text" name="nome" id="nome" value="<?php echo isset($nome) ? htmlspecialchars($nome) : ''; ?>" required><br>

                <label for="email">E-mail:</label>
                <input type="email" name="email" id="email" value="<?php echo isset($email) ? htmlspecialchars($email) : ''; ?>" required><br>

                <label for="assunto">Assunto:</label>
                <input type="text" name="assunto" id="assunto" value="<?php echo isset($assunto) ? htmlspecialchars($assunto) : ''; ?>"><br>

                <label for="mensagem">Mensagem:</label>
                <textarea name="mensagem" id="mensagem" required><?php echo isset($mensagem) ? htmlspecialchars($mensagem) : ''; ?></textarea><br>

                <div class="botao_faleconosco">
                    <input type="submit" value="Enviar">
                </div>
            </form>
        </div>
    </div>
</body>
</html>
