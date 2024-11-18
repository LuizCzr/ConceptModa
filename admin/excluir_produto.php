<?php

include_once("conexao.php");

$codigo = $_REQUEST['codigo'];

try {
    // SQL com parâmetro para segurança
    $sql = "DELETE FROM produtos WHERE id_produto = :id_produto";

    // Preparar a consulta
    $stmt = $pdo->prepare($sql);

    // Vincular o parâmetro
    $stmt->bindParam(':id_produto', $codigo, PDO::PARAM_INT);

    // Executar a consulta
    if ($stmt->execute()) {
        echo "<h2>Produto excluído com sucesso.</h2>";
    } else {
        echo "Não foi possível apagar o produto.";
    }

} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}

?>
