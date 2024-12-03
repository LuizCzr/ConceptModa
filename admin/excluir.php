<?php
include_once("conexao.php");

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    try {
        $sql = "DELETE FROM mensagens_contato WHERE id_mensagem = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            echo "<h2>Mensagem apagada com sucesso.</h2>";
        } else {
            echo "<h2>Não foi possível apagar a mensagem. ID não encontrado.</h2>";
        }
    } catch (PDOException $e) {
        echo "<h2>Erro: " . $e->getMessage() . "</h2>";
    }
} else {
    echo "<h2>ID inválido ou não fornecido.</h2>";
}
?>
