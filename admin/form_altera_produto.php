
<?php
include('conexao.php');

if (!isset($_GET['id_produto'])) {
   echo "ID do produto não fornecido";
   exit;
}

$id_produto = $_GET['id_produto'];

$sql = 'SELECT * FROM produtos WHERE id_produto = :id';
$stmt = $pdo->prepare($sql);
$stmt->execute([':id' => $id_produto]);
$produto = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$produto) {
   echo "Produto não encontrado";
   exit;
}

$sql_cat = 'SELECT id_categoria FROM produto_categoria WHERE id_produto = :id';
$stmt_cat = $pdo->prepare($sql_cat);
$stmt_cat->execute([':id' => $id_produto]);
$categoriasAssociadas = $stmt_cat->fetchAll(PDO::FETCH_COLUMN);
?>

<h3>Alterar Produto</h3>
<form action="?pg=altera_produto" method="post">
   <input type="hidden" name="id_produto" value="<?php echo $produto['id_produto']; ?>">
   
   <label>Nome:</label>
   <input type="text" name="nome" value="<?php echo $produto['nome']; ?>" required><br>
   
   <label>Preço:</label>
   <input type="text" name="preco" value="<?php echo $produto['preco']; ?>" required><br>
   
   <label>Imagem:</label>
   <input type="text" name="imagem" value="<?php echo $produto['imagem_url']; ?>" required><br>
   
   <label>Descrição:</label>
   <input type="text" name="descricao" value="<?php echo $produto['descricao']; ?>" required><br>
   
   <label>Categorias:</label>
   <select name="categorias[]" multiple required>
       <?php
       $sql = 'SELECT id_categoria, nome FROM categorias';
       $stmt = $pdo->query($sql);
       while ($categoria = $stmt->fetch(PDO::FETCH_ASSOC)) {
           $selected = in_array($categoria['id_categoria'], $categoriasAssociadas) ? 'selected' : '';
           echo "<option value='" . $categoria['id_categoria'] . "' $selected>" . 
                htmlspecialchars($categoria['nome']) . "</option>";
       }
       ?>
   </select><br>
   
   <label>Quantidade em estoque:</label>
   <input type="number" name="quantidade_estoque" value="<?php echo $produto['quantidade_estoque']; ?>" required><br>
   
   <input type="submit" value="Alterar">
</form>