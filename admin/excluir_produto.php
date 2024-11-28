<?php
include_once("conexao.php");

$codigo = $_REQUEST['codigo'];

try {
    // Primeiro deleta os registros na tabela de relacionamento
    $sql_categoria = "DELETE FROM produto_categoria WHERE id_produto = :id_produto";
    $stmt_categoria = $pdo->prepare($sql_categoria);
    $stmt_categoria->bindParam(':id_produto', $codigo, PDO::PARAM_INT);
    $stmt_categoria->execute();

    // Depois deleta o produto
    $sql = "DELETE FROM produtos WHERE id_produto = :id_produto";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id_produto', $codigo, PDO::PARAM_INT);

    if ($stmt->execute()) {
        echo "<h2>Produto excluído com sucesso.</h2>";
    } else {
        echo "Não foi possível apagar o produto.";
    }

} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}
?>