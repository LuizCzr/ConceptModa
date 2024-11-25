<?php

include('conexao.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_produto = $_POST['id_produto'];
    $nome = $_POST['nome'];
    $preco = $_POST['preco'];
    $imagem = $_POST['imagem'];
    $descricao = $_POST['descricao'];
    $quantidade_estoque = $_POST['quantidade_estoque'];
    $categorias = $_POST['categorias']; 

    $sql = 'UPDATE produtos SET nome = :nome, descricao = :descricao, preco = :preco, 
            quantidade_estoque = :quantidade_estoque, imagem_url = :imagem 
            WHERE id_produto = :id_produto';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':id_produto' => $id_produto,
        ':nome' => $nome,
        ':descricao' => $descricao,
        ':preco' => $preco,
        ':quantidade_estoque' => $quantidade_estoque,
        ':imagem' => $imagem
    ]);

    $sql_delete = 'DELETE FROM produto_categoria WHERE id_produto = :id_produto';
    $stmt_delete = $pdo->prepare($sql_delete);
    $stmt_delete->execute([':id_produto' => $id_produto]);

    foreach ($categorias as $id_categoria) {
        $sql_categoria = 'INSERT INTO produto_categoria (id_produto, id_categoria) 
                          VALUES (:id_produto, :id_categoria)';
        $stmt_categoria = $pdo->prepare($sql_categoria);
        $stmt_categoria->execute([
            ':id_produto' => $id_produto,
            ':id_categoria' => $id_categoria
        ]);
    }

    echo "Produto alterado com sucesso!";
}
?>
