<?php
require_once 'conexao.php';
?>

<main>
    <section id="produtos">
        <h2>Produtos</h2>
        <div class="grid-produtos">
            <?php
            $produtosPorPagina = 12;
            $paginaAtual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
            $inicio = ($paginaAtual - 1) * $produtosPorPagina;

            $stmt = $pdo->prepare("SELECT * FROM produtos LIMIT :inicio, :quantidade");
            $stmt->bindValue(':inicio', $inicio, PDO::PARAM_INT); 
            $stmt->bindValue(':quantidade', $produtosPorPagina, PDO::PARAM_INT);
            $stmt->execute(); 

            $produtosPagina = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($produtosPagina as $produto) {
                echo "
                    <div class='produto'>
                        <img src='{$produto['imagem_url']}' alt='{$produto['nome']}'>
                        <h3>{$produto['nome']}</h3>
                        <p>R$ " . number_format($produto['preco'], 2, ',', '.') . "</p>
                    </div>
                ";
            }

            $totalProdutos = $pdo->query("SELECT COUNT(*) FROM produtos")->fetchColumn();
            $totalPaginas = ceil($totalProdutos / $produtosPorPagina);

            echo "<div class='paginacao'>";
            for ($i = 1; $i <= $totalPaginas; $i++) {
                $classeAtiva = ($i === $paginaAtual) ? "class='ativo'" : "";
                echo "<a href='?pagina=$i' $classeAtiva>$i</a>";
            }
            echo "</div>";
            ?>
        </div>
    </section>
</main>
