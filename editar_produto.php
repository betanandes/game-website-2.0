<?php
require 'db.php';

session_start();

if (!isset($_SESSION['tipo_usuario']) || $_SESSION['tipo_usuario'] !== 'master') {
    die("Acesso negado.");
}


// Verificar se o ID foi passado
if (!isset($_GET['id'])) {
    die("ID do produto não especificado.");
}

$id = (int)$_GET['id'];

// Buscar os dados do produto
$sql = "SELECT * FROM produtos WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute([':id' => $id]);
$produto = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$produto) {
    die("Produto não encontrado.");
}

// Atualizar o produto no banco
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $preco = $_POST['preco'];
    $imagem = $_POST['imagem'];
    $categoria = $_POST['categoria'];

    $sql = "UPDATE produtos SET nome = :nome, preco = :preco, imagem = :imagem, categoria = :categoria WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':nome' => $nome,
        ':preco' => $preco,
        ':imagem' => $imagem,
        ':categoria' => $categoria,
        ':id' => $id,
    ]);

    echo "Produto atualizado com sucesso!";
    header("Location: consulta_produtos.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <link rel="stylesheet" href="editar_produto.css">
    <link rel="shortcut icon" href="./assets/gamex-favicon.png" type="image/x-icon">
    <title>Editar Produtos</title>
</head>
<body>
    <div class="container">
        <h1>Editar Produto</h1>
        <form method="post">
            <label>Nome:</label>
            <input type="text" name="nome" value="<?= $produto['nome']; ?>" required><br>

            <label>Preço:</label>
            <input type="number" step="0.01" name="preco" value="<?= $produto['preco']; ?>" required><br>

            <label>Imagem:</label>
            <input type="text" name="imagem" value="<?= $produto['imagem']; ?>"><br>

            <label>Categoria:</label>
            <input type="text" name="categoria" value="<?= $produto['categoria']; ?>" required><br>

            <button type="submit">Salvar</button>
        </form>

        <!-- Botão de Voltar -->
        <a href="consulta_produtos.php" class="btn-back">Voltar para a Consulta de Produtos</a>
    </div>
</body>
</html>

