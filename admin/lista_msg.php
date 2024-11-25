<h2>Listagem de mensagens</h2>

<?php

include_once("conexao.php");

try {
    $sql = "SELECT * FROM mensagens_contato";
    $stmt = $pdo->query($sql);

    while ($tabela = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "Nome: " . htmlspecialchars($tabela['nome']) . "<br>";
        echo "E-mail: " . htmlspecialchars($tabela['email']) . "<br>";
        echo "Assunto: " . htmlspecialchars($tabela['assunto']) . "<br>";
        echo "Mensagem: " . nl2br(htmlspecialchars($tabela['mensagem'])) . "<br>";
        echo "<a href=?pg=excluir&id=" . $tabela['id_mensagem'] . ">[x] Excluir mensagem</a><br>";
        echo "<hr>";
    }
} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}

?>
