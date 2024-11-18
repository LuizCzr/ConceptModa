<?php

include_once("conexao.php");

$codigo = $_REQUEST['codigo'];

try {
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
