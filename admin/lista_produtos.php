<h2>Listagem de produtos</h2>
<h3><a href="?pg=form_produto">Cadastrar novo produto</a></h3>

<?php
include_once("conexao.php");

try {
    $sql = "SELECT p.id_produto, p.nome, p.preco, p.imagem_url, p.descricao, 
            GROUP_CONCAT(c.nome ORDER BY c.nome ASC) AS categorias
            FROM produtos p
            LEFT JOIN produto_categoria pc ON p.id_produto = pc.id_produto
            LEFT JOIN categorias c ON pc.id_categoria = c.id_categoria
            GROUP BY p.id_produto";
    
    $stmt = $pdo->query($sql);

    if ($stmt->rowCount() > 0) {
        while ($tabela = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "Nome: " . htmlspecialchars($tabela['nome']) . "<br>";
            echo "Preço: R$ " . number_format($tabela['preco'], 2, ',', '.') . "<br>";
            // Caminho ajustado para a imagem
            echo "Imagem: <img src='../" . htmlspecialchars($tabela['imagem_url']) . "' alt='Imagem do Produto' style='max-width:100px;'><br>";
            echo "Descrição: " . htmlspecialchars($tabela['descricao']) . "<br>";
            echo "Categoria(s): " . htmlspecialchars($tabela['categorias']) . "<br>";
            echo "<a href=\"?pg=excluir_produto&codigo=" . htmlspecialchars($tabela['id_produto']) . "\">[x] Excluir produto</a><br>";
            echo "<a href=\"?pg=form_altera_produto&codigo=" . htmlspecialchars($tabela['id_produto']) . "\">[v] Alterar produto</a><br>";
            echo "<hr>";
        }
    } else {
        echo "Nenhum produto encontrado.";
    }
} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}
?>
