<?php
require_once 'conexao.php';

if (isset($_GET['id'])) {
    $id_produto = intval($_GET['id']);

    $stmt = $pdo->prepare("SELECT * FROM produtos WHERE id_produto = :id_produto");
    $stmt->bindParam(':id_produto', $id_produto, PDO::PARAM_INT);
    $stmt->execute();

    $produto = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($produto) {
        echo "
        <main>
            <section id='produto'>
                <div class='produto-detalhes'>
                    <div class='produto-imagem'>
                        <img src='" . htmlspecialchars($produto['imagem_url']) . "' alt='" . htmlspecialchars($produto['nome']) . "'>
                    </div>
                    <div class='produto-info'>
                        <h1>" . htmlspecialchars($produto['nome']) . "</h1>
                        <p>" . htmlspecialchars($produto['descricao']) . "</p>
                        <p><strong>Preço:</strong> R$ " . number_format($produto['preco'], 2, ',', '.') . "</p>
                        <a href='?pg=carrinho&acao=add&id=" . $produto['id_produto'] . "' class='botao-comprar'>Adicionar ao Carrinho</a>
                    </div>
                </div>
            </section>
        </main>
        ";
    } else {
        echo "<p>Produto não encontrado.</p>";
    }
} else {
    echo "<p>Produto não especificado.</p>";
}
?>
