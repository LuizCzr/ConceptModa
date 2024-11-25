<h3> Cadastro de Produto</h3>
<form action="?pg=cadastra_produto" method="post">
    <label>Nome:</label>
    <input type="text" name="nome" required><br>
    
    Preço: <input type="text" name="preco" required><br>
    
    Imagem: <input type="text" name="imagem" placeholder="Caminho da imagem" required><br>
    
    Descrição: <input type="text" name="descricao" required><br>
    
    Categorias:
    <select name="categorias[]" multiple required>
        <?php
        include('conexao.php');
        $sql = 'SELECT id_categoria, nome FROM categorias';
        $stmt = $pdo->query($sql);
        while ($categoria = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<option value='" . $categoria['id_categoria'] . "'>" . $categoria['nome'] . "</option>";
        }
        ?>
    </select><br>
    
    Quantidade em estoque: <input type="number" name="quantidade_estoque" required><br>
    
    <input type="submit" value="Enviar">
</form>
