<?php
include_once("conexao.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $assunto = $_POST['assunto'];
    $mensagem = $_POST['mensagem'];

    try {
        $sql = "INSERT INTO mensagens_contato (nome, email, assunto, mensagem) VALUES (:nome, :email, :assunto, :mensagem)";
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':assunto', $assunto);
        $stmt->bindParam(':mensagem', $mensagem);

        if ($stmt->execute()) {
            $sucesso = "Mensagem enviada com sucesso.";
        } else {
            $erro = "Não foi possível enviar a mensagem.";
        }
    } catch (PDOException $e) {
        $erro = "Erro: " . $e->getMessage();
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
                <h2><?php echo $sucesso; ?></h2>
            <?php elseif (isset($erro)): ?>
                <h2><?php echo $erro; ?></h2>
            <?php endif; ?>

            <form action="" method="post">
                Nome: <input type="text" name="nome" required><br>
                E-mail: <input type="email" name="email" required><br>
                Assunto: <input type="text" name="assunto"><br>
                Mensagem: <textarea name="mensagem" required></textarea><br>
                <div class="botao_faleconosco">
                    <input type="submit" value="Enviar">
                </div>
            </form>
        </div>
    </div>
</body>
</html>
