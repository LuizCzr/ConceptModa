<?php

include('conexao.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $preco = $_POST['preco'];
    $imagem = $_POST['imagem'];
    $descricao = $_POST['descricao'];
    $quantidade_estoque = $_POST['quantidade_estoque'];
    $categorias = $_POST['categorias'];
    $sql = 'INSERT INTO produtos (nome, descricao, preco, quantidade_estoque, imagem_url) 
            VALUES (:nome, :descricao, :preco, :quantidade_estoque, :imagem)';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':nome' => $nome,
        ':descricao' => $descricao,
        ':preco' => $preco,
        ':quantidade_estoque' => $quantidade_estoque,
        ':imagem' => $imagem
    ]);
    
    $id_produto = $pdo->lastInsertId();

    foreach ($categorias as $id_categoria) {
        $sql_categoria = 'INSERT INTO produto_categoria (id_produto, id_categoria) 
                          VALUES (:id_produto, :id_categoria)';
        $stmt_categoria = $pdo->prepare($sql_categoria);
        $stmt_categoria->execute([
            ':id_produto' => $id_produto,
            ':id_categoria' => $id_categoria
        ]);
    }

    echo "Produto cadastrado com sucesso!";
}
?>
