<?php

include_once("conexao.php");

$codigo = $_REQUEST['codigo'];

try {
    // Preparar a consulta SQL
    $sql = "SELECT * FROM produtos WHERE id_produto = :id_produto";
    
    // Preparar a consulta no PDO
    $stmt = $pdo->prepare($sql);

    // Vincular o parâmetro :codigo com a variável $codigo
    $stmt->bindParam(':id_produto', $codigo, PDO::PARAM_INT);

    // Executar a consulta
    $stmt->execute();

    // Buscar o resultado da consulta
    $dados = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // Verificar se os dados foram encontrados
    if (!$dados) {
        echo "Produto não encontrado.";
        exit;
    }

} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}

?>

<h3>Cadastro de Produto</h3>
<form action="?pg=altera_produto&id_produto=<?= $dados['id_produto']; ?>" method="post">
    <label>Nome:</label>
    <input type="text" name="nome" value="<?= htmlspecialchars($dados['nome']); ?>" required><br>
    Preço: <input type="text" name="preco" value="<?= htmlspecialchars($dados['preco']); ?>"><br>
    Imagem: <input type="text" name="imagem" value="<?= htmlspecialchars($dados['imagem']); ?>"><br>
    Descrição: <input type="text" name="descricao" value="<?= htmlspecialchars($dados['descricao']); ?>" required><br>
    Categoria: <input type="text" name="categoria" value="<?= htmlspecialchars($dados['categoria']); ?>" required><br>
    <input type="submit" value="Enviar">
</form>
