<h3> Alterar Produto</h3>
<form action="?pg=altera_produto" method="post">
    <label>Nome:</label>
    <input type="text" name="nome" value="<?php echo $produto['nome']; ?>" required><br>
    
    Preço: <input type="text" name="preco" value="<?php echo $produto['preco']; ?>" required><br>
    
    Imagem: <input type="text" name="imagem" value="<?php echo $produto['imagem_url']; ?>" placeholder="Caminho da imagem" required><br>
    
    Descrição: <input type="text" name="descricao" value="<?php echo $produto['descricao']; ?>" required><br>
    
    Categorias:
    <select name="categorias[]" multiple required>
        <?php
        include('conexao.php');
        $sql = 'SELECT id_categoria, nome FROM categorias';
        $stmt = $pdo->query($sql);
        while ($categoria = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $selected = in_array($categoria['id_categoria'], $categoriasAssociadas) ? 'selected' : '';
            echo "<option value='" . $categoria['id_categoria'] . "' $selected>" . $categoria['nome'] . "</option>";
        }
        ?>
    </select><br>
    
    Quantidade em estoque: <input type="number" name="quantidade_estoque" value="<?php echo $produto['quantidade_estoque']; ?>" required><br>
    
    <input type="submit" value="Alterar">
</form>
