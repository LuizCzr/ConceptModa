<main>
    <section id="produtos">
        <h2>Produtos</h2>
        <div class="grid-produtos">
            <?php
            // Simulação de produtos (substituir por dados do banco de dados se necessário)
            $produtos = [
                ["nome" => "Produto 1", "imagem" => "produto1.jpg", "preco" => "R$ 99,90"],
                ["nome" => "Produto 2", "imagem" => "produto2.jpg", "preco" => "R$ 199,90"],
                ["nome" => "Produto 3", "imagem" => "produto3.jpg", "preco" => "R$ 299,90"],
                ["nome" => "Produto 4", "imagem" => "produto4.jpg", "preco" => "R$ 399,90"],
                ["nome" => "Produto 5", "imagem" => "produto5.jpg", "preco" => "R$ 499,90"],
                ["nome" => "Produto 6", "imagem" => "produto6.jpg", "preco" => "R$ 599,90"],
                ["nome" => "Produto 7", "imagem" => "produto7.jpg", "preco" => "R$ 699,90"],
                ["nome" => "Produto 8", "imagem" => "produto8.jpg", "preco" => "R$ 799,90"],
                ["nome" => "Produto 9", "imagem" => "produto9.jpg", "preco" => "R$ 899,90"],
                ["nome" => "Produto 10", "imagem" => "produto10.jpg", "preco" => "R$ 999,90"],
                ["nome" => "Produto 11", "imagem" => "produto11.jpg", "preco" => "R$ 1099,90"],
                ["nome" => "Produto 12", "imagem" => "produto12.jpg", "preco" => "R$ 1199,90"],
                ["nome" => "Produto 13", "imagem" => "produto13.jpg", "preco" => "R$ 1299,90"],
                // Mais produtos...
            ];

            // Paginação
            $produtosPorPagina = 12;
            $paginaAtual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
            $inicio = ($paginaAtual - 1) * $produtosPorPagina;
            $produtosPagina = array_slice($produtos, $inicio, $produtosPorPagina);

            foreach ($produtosPagina as $produto) {
                echo "
                    <div class='produto'>
                        <img src='{$produto['imagem']}' alt='{$produto['nome']}'>
                        <h3>{$produto['nome']}</h3>
                        <p>{$produto['preco']}</p>
                    </div>
                ";
            }

            // Links de Paginação
            $totalPaginas = ceil(count($produtos) / $produtosPorPagina);
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
