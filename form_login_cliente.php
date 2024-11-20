<?php  
include_once("conexao.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    session_start();

    $email = $_POST['email'];
    $senha = $_POST['senha'];

    try {
        $stmt = $pdo->prepare("SELECT senha, id FROM clientes WHERE email = :email");
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $dado = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($dado) {
            if (password_verify($senha, $dado['senha'])) { 
                $_SESSION['usuario'] = $dado['id'];
                $_SESSION['email'] = $email;
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

<div class="form_login_cliente">
    <form action="" method="post">
        <label>E-mail 
            <input value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>" 
                   type="text" 
                   name="email" 
                   required>
        </label><br>
        <label>Senha 
            <input type="password" name="senha" required>
        </label><br>
        <a href="?pg=form_cadastro_cliente.php">Cadastre-se</a>
        <a href="?pg=recuperar_senha.php">Esqueceu a senha?</a>
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
