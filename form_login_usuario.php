<?php  
include_once("conexao.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    session_start();

    $email = $_POST['email'];
    $senha = $_POST['senha'];

    try {
        $stmt = $pdo->prepare("SELECT senha, id_usuario, tipo_usuario FROM usuarios WHERE email = :email");
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $dado = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($dado) {
            if (password_verify($senha, $dado['senha'])) { 
                $_SESSION['usuario'] = $dado['id_usuario'];
                $_SESSION['email'] = $email;
                $_SESSION['tipo_usuario'] = $dado['tipo_usuario']; // Cliente ou administrador
                header("Location: index.php");
                exit;
            } else {
                $erro[] = "Senha incorreta.";
            }
        } else {
            $erro[] = "Este email não pertence a nenhum usuário.";
        }
    } catch (PDOException $e) {
        die("Erro ao consultar o banco de dados: " . $e->getMessage());
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Concept Moda</title>
    <link rel="stylesheet" href="CSS/styles.css">
</head>
<body>
<div class="login">
    <div class="tela_login">
        <h1>Concept Moda</h1>
        <br>
        <form action="" method="post">
            <label>E-mail
                <input value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>" type="text" name="email" required>
            </label>
            <br>
            <label>Senha
                <input type="password" name="senha" required>
            </label>
            <br>
            <a href="?pg=form_cadastro_cliente">Cadastre-se</a>

            <a href="?pg=recuperar_senha">Esqueceu a senha?</a>
            <br>
            <div class="botao_login">
                <input type="submit" value="Logar"><br>
            </div>
        </form>
        
        <?php
        if (isset($erro)) {
            foreach ($erro as $mensagem) {
                echo "<p style='color: red;'>$mensagem</p>";
            }
        }
        ?>
    </div>
</div>
</body>
</html>
