<?php
require_once 'conexao.php';

$paginaAtual = isset($_GET['pagina']) ? filter_var($_GET['pagina'], FILTER_VALIDATE_INT) : 1;
$paginaAtual = max(1, $paginaAtual);

$produtosPorPagina = 12;
$inicio = ($paginaAtual - 1) * $produtosPorPagina;

$termoBusca = isset($_GET['busca']) ? trim($_GET['busca']) : '';

$sql = "SELECT * FROM produtos";
if (!empty($termoBusca)) {
    $sql .= " WHERE nome LIKE :busca";
}
$sql .= " LIMIT :inicio, :quantidade";

$stmt = $pdo->prepare($sql);
if (!empty($termoBusca)) {
    $stmt->bindValue(':busca', '%' . $termoBusca . '%', PDO::PARAM_STR);
}
$stmt->bindValue(':inicio', $inicio, PDO::PARAM_INT);
$stmt->bindValue(':quantidade', $produtosPorPagina, PDO::PARAM_INT);
$stmt->execute();

$produtosPagina = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<section id="pesquisa">
    <form method="get" action="">
        <input type="hidden" name="pg" value="conteudo">
        <input type="text" name="busca" placeholder="Pesquisar produtos" value="<?= htmlspecialchars($termoBusca) ?>">
        <button type="submit">Buscar</button>
    </form>
</section>

<section id="produtos">
    <div class="grid-produtos">
        <?php
        foreach ($produtosPagina as $produto) {
            echo "
                <div class='produto'>
                    <img src='" . htmlspecialchars($produto['imagem_url']) . "' alt='" . htmlspecialchars($produto['nome']) . "'>
                    <h3>" . htmlspecialchars($produto['nome']) . "</h3>
                    <p>R$ " . number_format($produto['preco'], 2, ',', '.') . "</p>
                    <a href='?pg=produto&id=" . $produto['id_produto'] . "' class='botao-comprar'>Comprar</a>
                </div>
            ";
        }

        $totalProdutosQuery = "SELECT COUNT(*) FROM produtos";
        if (!empty($termoBusca)) {
            $totalProdutosQuery .= " WHERE nome LIKE :busca";
        }
        $stmtCount = $pdo->prepare($totalProdutosQuery);
        if (!empty($termoBusca)) {
            $stmtCount->bindValue(':busca', '%' . $termoBusca . '%', PDO::PARAM_STR);
        }
        $stmtCount->execute();
        $totalProdutos = $stmtCount->fetchColumn();

        $totalPaginas = ceil($totalProdutos / $produtosPorPagina);

        echo "<div class='paginacao'>";
        for ($i = 1; $i <= $totalPaginas; $i++) {
            $classeAtiva = ($i === $paginaAtual) ? "class='ativo'" : "";
            $queryParams = http_build_query(['pg' => 'conteudo', 'pagina' => $i, 'busca' => $termoBusca]);
            echo "<a href='?$queryParams' $classeAtiva>$i</a>";
        }
        echo "</div>";
        ?>
    </div>
</section>
