<?php
require 'db.php';

session_start();

if (!isset($_SESSION['tipo_usuario']) || $_SESSION['tipo_usuario'] !== 'master') {
    die("Acesso negado.");
}


// Puxar produtos do banco
$sql = "SELECT * FROM produtos";
$stmt = $pdo->query($sql);
$produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Consulta Produtos</title>
</head>
<body>
    <h1>Produtos</h1>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Preço</th>
                <th>Imagem</th>
                <th>Categoria</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($produtos as $produto): ?>
            <tr>
                <td><?= $produto['id']; ?></td>
                <td><?= $produto['nome']; ?></td>
                <td>R$<?= number_format($produto['preco'], 2, ',', '.'); ?></td>
                <td><img src="<?= $produto['imagem']; ?>" width="50" alt="<?= $produto['nome']; ?>"></td>
                <td><?= $produto['categoria']; ?></td>
                <td>
                    <a href="editar_produto.php?id=<?= $produto['id']; ?>">Editar</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
