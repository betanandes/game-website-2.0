<?php
require 'db.php';
session_start();

// Verifica se o usuário está logado e é "master"
if (!isset($_SESSION['tipo_usuario']) || $_SESSION['tipo_usuario'] != 'master') {
    header("Location: login.php");
    exit();
}

// Verifica se o ID do usuário foi passado na URL
if (!isset($_GET['id'])) {
    die("ID do usuário não especificado.");
}

$id = (int)$_GET['id'];

// Consulta os dados do usuário
$sql = "SELECT id, nome, email FROM usuarios WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute(['id' => $id]);
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$usuario) {
    die("Usuário não encontrado.");
}

// Atualiza os dados do usuário
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];

    // Atualiza os dados no banco
    $sql = "UPDATE usuarios SET nome = :nome, email = :email WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':nome' => $nome,
        ':email' => $email,
        ':id' => $id
    ]);

    echo "Usuário atualizado com sucesso!";
    header("Location: consulta_usuarios.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="consulta_usuarios.css">
    <link rel="shortcut icon" href="assets/gamex-favicon.png" type="image/x-icon">
    <title>Editar Usuário</title>
</head>
<body>
    <div class="container">
        <h1>Editar Usuário</h1>
        <form method="POST">
            <label>Nome:</label>
            <input type="text" name="nome" value="<?= htmlspecialchars($usuario['nome']); ?>" required><br>

            <label>Email:</label>
            <input type="email" name="email" value="<?= htmlspecialchars($usuario['email']); ?>" required><br>

            <button type="submit">Salvar</button>
        </form>
        
        <!-- Botão de Voltar -->
        <a href="consulta_usuarios.php" class="btn-back">Voltar para a Consulta de Usuários</a>
    </div>
</body>
</html>
