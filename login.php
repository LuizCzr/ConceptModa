<?php
session_start();
include_once("conexao.php");

if (isset($_POST['login'])) {
    $email = trim($_POST['email']);
    $senha = $_POST['senha'];

    try {
        $sql = "SELECT * FROM usuarios WHERE email = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
            if (password_verify($senha, $usuario['senha'])) {
                session_regenerate_id(true);
                
                $_SESSION['usuario'] = $usuario['id_usuario'];
                $_SESSION['email'] = $usuario['email'];
                $_SESSION['tipo_usuario'] = $usuario['tipo_usuario'];
                $_SESSION['nome'] = $usuario['nome']; 

                $redirect = isset($_GET['redirect']) ? $_GET['redirect'] : 'index.php';

                $url_referer = parse_url($redirect, PHP_URL_HOST);
                if ($url_referer === '' || $url_referer === $_SERVER['HTTP_HOST']) {
                    header("Location: $redirect");
                } else {
                    header("Location: index.php");
                }

                exit();
            } else {
                $erro = "Senha incorreta!";
            }
        } else {
            $erro = "Usuário não encontrado!";
        }
    } catch (PDOException $e) {
        $erro = "Erro: " . $e->getMessage();
    }
}

if (isset($erro)) {
    echo "<p style='color:red;'>$erro</p>";
}
?>
