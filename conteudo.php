<?php
require_once 'conexao.php';

$paginaAtual = isset($_GET['pagina']) ? filter_var($_GET['pagina'], FILTER_VALIDATE_INT) : 1;
$paginaAtual = max(1, $paginaAtual);

$produtosPorPagina = 12;
$inicio = ($paginaAtual - 1) * $produtosPorPagina;

$stmt = $pdo->prepare("SELECT * FROM produtos LIMIT :inicio, :quantidade");
$stmt->bindValue(':inicio', $inicio, PDO::PARAM_INT); 
$stmt->bindValue(':quantidade', $produtosPorPagina, PDO::PARAM_INT);
$stmt->execute(); 

$produtosPagina = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<main>
    <section id="produtos">
        <div class="grid-produtos">
            <?php
            foreach ($produtosPagina as $produto) {
                echo "
                    <div class='produto'>
                        <img src='" . htmlspecialchars($produto['imagem_url']) . "' alt='" . htmlspecialchars($produto['nome']) . "'>
                        <h3>" . htmlspecialchars($produto['nome']) . "</h3>
                        <p>R$ " . number_format($produto['preco'], 2, ',', '.') . "</p>
                        <a href='produto.php?id=" . $produto['id_produto'] . "' class='botao-comprar'>Comprar</a>
                    </div>
                ";
            }

            $totalProdutos = $pdo->query("SELECT COUNT(*) FROM produtos")->fetchColumn();
            $totalPaginas = ceil($totalProdutos / $produtosPorPagina);

            if ($paginaAtual > $totalPaginas) {
                $paginaAtual = $totalPaginas;
            }

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
