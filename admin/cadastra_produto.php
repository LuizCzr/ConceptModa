<?php

include_once("conexao.php");

$nome = $_REQUEST['nome'];
$preco = $_REQUEST['preco'];
$imagem = $_REQUEST['imagem'];
$descricao = $_REQUEST['descricao'];
$categoria = $_REQUEST['categoria'];

$sql = "INSERT INTO produtos (nome, preco, imagem, descricao, categoria) 
        VALUES (:nome, :preco, :imagem, :descricao, :categoria)";

try {
    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':preco', $preco);
    $stmt->bindParam(':imagem', $imagem);
    $stmt->bindParam(':descricao', $descricao);
    $stmt->bindParam(':categoria', $categoria);

    if ($stmt->execute()) {
        echo "<h2> Produto Cadastrado com sucesso.</h2>";
    } else {
        echo "<h2> Não foi possível cadastrar o produto.</h2>";
    }

} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}
?>
