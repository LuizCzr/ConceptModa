<h2>Listagem de produtos</h2>
<h3><a href="?pg=form_produto">Cadastrar novo produto</a></h3>

<?php

include_once("conexao.php");

try {
    $sql = "SELECT * FROM produtos";
    $stmt = $pdo->query($sql);

    if ($stmt->rowCount() > 0) {
        while ($tabela = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "Nome: " . htmlspecialchars($tabela['nome']) . "<br>";
            echo "Preço: " . htmlspecialchars($tabela['preco']) . "<br>";
            echo "Imagem: " . htmlspecialchars($tabela['imagem']) . "<br>";
            echo "Descrição: " . htmlspecialchars($tabela['descricao']) . "<br>";
            echo "Categoria: " . htmlspecialchars($tabela['categoria']) . "<br>";
            echo "<a href=?pg=excluir_produto&codigo=" . htmlspecialchars($tabela['id_produto']) . ">[x] Excluir produto</a><br>";
            echo "<a href=?pg=form_altera_produto&codigo=" . htmlspecialchars($tabela['id_produto']) . ">[v] Alterar produto</a><br>";
            echo "<hr>";
        }
    } else {
        echo "Nenhum produto encontrado.";
    }
} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}

?>
