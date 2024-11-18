<?php

include_once("conexao.php");

$codigo = $_REQUEST['id_produto'];
$nome = $_REQUEST['nome'];
$preco = $_REQUEST['preco'];
$imagem = $_REQUEST['imagem'];
$descricao = $_REQUEST['descricao'];
$categoria = $_REQUEST['categoria'];

try {
    $sql = "UPDATE produtos SET
            nome = :nome, preco = :preco, imagem = :imagem, descricao = :descricao, categoria = :categoria
            WHERE id_produto = :id_produto";

    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':preco', $preco);
    $stmt->bindParam(':imagem', $imagem);
    $stmt->bindParam(':descricao', $descricao);
    $stmt->bindParam(':categoria', $categoria);
    $stmt->bindParam(':id_produto', $codigo, PDO::PARAM_INT);

    if ($stmt->execute()) {
        echo "<h2>Produto alterado com sucesso.</h2>";
    } else {
        echo "<h2>Não foi possível alterar o produto.</h2>";
    }

} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}

?>
