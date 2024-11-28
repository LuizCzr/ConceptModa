<?php
require_once 'conexao.php';

if (!isset($_SESSION['id_carrinho'])) {
    $id_usuario = 1; 
    $stmt = $pdo->prepare("INSERT INTO carrinhos (id_usuario, status) VALUES (?, 'aberto')");
    $stmt->execute([$id_usuario]);

    $_SESSION['id_carrinho'] = $pdo->lastInsertId();
}

$id_carrinho = $_SESSION['id_carrinho'];

if (isset($_GET['acao']) && $_GET['acao'] == 'add') {
    $id_produto = intval($_GET['id']);
    
    $stmt = $pdo->prepare("SELECT * FROM itens_carrinho WHERE id_carrinho = ? AND id_produto = ?");
    $stmt->execute([$id_carrinho, $id_produto]);
    $produtoNoCarrinho = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($produtoNoCarrinho) {
        $stmt = $pdo->prepare("UPDATE itens_carrinho SET quantidade = quantidade + 1 WHERE id_carrinho = ? AND id_produto = ?");
        $stmt->execute([$id_carrinho, $id_produto]);
    } else {
        $stmt = $pdo->prepare("INSERT INTO itens_carrinho (id_carrinho, id_produto, quantidade) VALUES (?, ?, 1)");
        $stmt->execute([$id_carrinho, $id_produto]);
    }
}

$stmt = $pdo->prepare("SELECT i.*, p.nome, p.preco, p.imagem_url FROM itens_carrinho i JOIN produtos p ON i.id_produto = p.id_produto WHERE i.id_carrinho = ?");
$stmt->execute([$id_carrinho]);
$produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<main>
    <h2 class="titulo-carrinho">Carrinho de Compras</h2>
    <?php
    if (empty($produtos)) {
        echo '<p>Carrinho vazio</p>';
    } else {
        echo '<table class="tabela-carrinho">
                <tr>
                    <th>Produto</th>
                    <th>Quantidade</th>
                    <th>Preço</th>
                    <th>Subtotal</th>
                    <th>Ação</th>
                </tr>';

        $total = 0;
        foreach ($produtos as $produto) {
            $id = $produto['id_produto'];
            $qtd = $produto['quantidade'];
            $subtotal = $produto['preco'] * $qtd;
            $total += $subtotal;

            echo '<tr>
                    <td>' . htmlspecialchars($produto['nome']) . '</td>
                    <td>' . $qtd . '</td>
                    <td>R$ ' . number_format($produto['preco'], 2, ',', '.') . '</td>
                    <td>R$ ' . number_format($subtotal, 2, ',', '.') . '</td>
                    <td><a href="?acao=del&id=' . $id . '" class="btn-remover">Remover</a></td>
                  </tr>';
        }

        echo '<tr>
                <td colspan="3"><strong>Total</strong></td>
                <td colspan="2"><strong>R$ ' . number_format($total, 2, ',', '.') . '</strong></td>
              </tr>';
        echo '</table>';

        echo '<div style="text-align: right; margin-top: 20px;">
                <a href="?acao=finalizar" class="btn-finalizar">Finalizar Compra</a>
              </div>';
    }
    ?>
</main>
