<?php
include_once("conexao.php");

if (!isset($_GET['codigo']) || empty($_GET['codigo'])) {
    echo "ID do produto não fornecido.";
    exit;
}

$id_produto = intval($_GET['codigo']);

try {
    // Buscar os dados do produto
    $sql = 'SELECT * FROM produtos WHERE id_produto = :id_produto';
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id_produto', $id_produto, PDO::PARAM_INT);
    $stmt->execute();
    $produto = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$produto) {
        echo "Produto não encontrado.";
        exit;
    }

    // Buscar categorias associadas
    $sql_cat = 'SELECT id_categoria FROM produto_categoria WHERE id_produto = :id_produto';
    $stmt_cat = $pdo->prepare($sql_cat);
    $stmt_cat->bindParam(':id_produto', $id_produto, PDO::PARAM_INT);
    $stmt_cat->execute();
    $categoriasAssociadas = $stmt_cat->fetchAll(PDO::FETCH_COLUMN);

} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
    exit;
}
?>

<h3>Alterar Produto</h3>
<form action="?pg=altera_produto" method="post">
    <input type="hidden" name="id_produto" value="<?php echo htmlspecialchars($produto['id_produto']); ?>">
    
    <label>Nome:</label>
    <input type="text" name="nome" value="<?php echo htmlspecialchars($produto['nome']); ?>" required><br>
    
    <label>Preço:</label>
    <input type="number" step="0.01" name="preco" value="<?php echo htmlspecialchars($produto['preco']); ?>" required><br>
    
    <label>Imagem (URL):</label>
    <input type="text" name="imagem_url" value="<?php echo htmlspecialchars($produto['imagem_url']); ?>" required><br>
    
    <label>Descrição:</label>
    <textarea name="descricao" required><?php echo htmlspecialchars($produto['descricao']); ?></textarea><br>
    
    <label>Categorias:</label>
    <select name="categorias[]" multiple required>
        <?php
        try {
            $sql = 'SELECT id_categoria, nome FROM categorias';
            $stmt = $pdo->query($sql);

            while ($categoria = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $selected = in_array($categoria['id_categoria'], $categoriasAssociadas) ? 'selected' : '';
                echo "<option value='" . htmlspecialchars($categoria['id_categoria']) . "' $selected>" . 
                     htmlspecialchars($categoria['nome']) . "</option>";
            }
        } catch (PDOException $e) {
            echo "Erro ao carregar categorias: " . $e->getMessage();
        }
        ?>
    </select><br>
    
    <label>Quantidade em estoque:</label>
    <input type="number" name="quantidade_estoque" value="<?php echo htmlspecialchars($produto['quantidade_estoque']); ?>" required><br>
    
    <input type="submit" value="Alterar">
</form>
