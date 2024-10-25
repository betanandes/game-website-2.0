<?php
session_start();
require 'db.php';

$usuario_id = $_SESSION['usuario_id']; // ID do usuário logado

// Recupera os itens do carrinho do usuário
$sql = "SELECT ic.produto_id, ic.quantidade, p.nome, p.preco 
        FROM itens_carrinho ic
        JOIN produtos p ON ic.produto_id = p.id
        JOIN carrinho c ON ic.carrinho_id = c.id
        WHERE c.usuario_id = :usuario_id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':usuario_id', $usuario_id);
$stmt->execute();
$itens_carrinho = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Carrinho de Compras</title>
</head>
<body>

<h1>Seu Carrinho</h1>

<?php if (!empty($itens_carrinho)): ?>
    <table>
        <thead>
            <tr>
                <th>Produto</th>
                <th>Quantidade</th>
                <th>Preço</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($itens_carrinho as $item): ?>
                <tr>
                    <td><?= htmlspecialchars($item['nome']) ?></td>
                    <td><?= $item['quantidade'] ?></td>
                    <td>R$<?= number_format($item['preco'], 2, ',', '.') ?></td>
                    <td>R$<?= number_format($item['preco'] * $item['quantidade'], 2, ',', '.') ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>Seu carrinho está vazio.</p>
<?php endif; ?>

</body>
</html>
