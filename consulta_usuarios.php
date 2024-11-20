<?php
require 'db.php'; // Conexão com o banco de dados
session_start();

// Verifica se o usuário está logado e é "master"
if (!isset($_SESSION['tipo_usuario']) || $_SESSION['tipo_usuario'] != 'master') {
    header("Location: login.php");
    exit();
}

// Obtém a string de pesquisa, se fornecida
$pesquisa = isset($_GET['pesquisa']) ? $_GET['pesquisa'] : '';

// Consulta os usuários comuns que contêm a substring no nome
$sql = "SELECT id, nome, email FROM usuarios WHERE tipo_usuario = 'comum' AND nome LIKE :pesquisa";
$stmt = $pdo->prepare($sql);
$stmt->execute(['pesquisa' => '%' . $pesquisa . '%']);
$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="consulta_usuarios.css">
    <link rel="shortcut icon" href="assets/gamex-favicon.png" type="image/x-icon">
    <title>Consulta de Usuários</title>
</head>
<body>
    <h1>Consulta de Usuários</h1>
    <form method="GET">
        <label for="pesquisa">Pesquisar por nome:</label>
        <input type="text" id="pesquisa" name="pesquisa" value="<?= htmlspecialchars($pesquisa) ?>">
        <button type="submit">Pesquisar</button>
    </form>

    <div class="button-container">
    <a href="index.php" class="btn-back">Voltar</a>
    </div>

    <h2>Lista de Usuários</h2>

    <?php if ($usuarios): ?>
        <table>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody>
    <?php foreach ($usuarios as $usuario): ?>
        <tr>
            <td><?= htmlspecialchars($usuario['nome']) ?></td>
            <td><?= htmlspecialchars($usuario['email']) ?></td>
            <td>
                <!-- Link para editar o usuário -->
                <a href="editar_usuario.php?id=<?= $usuario['id']; ?>" >Editar</a>
                <form method="POST" action="excluir_usuario.php" onsubmit="return confirm('Tem certeza que deseja excluir este usuário?');">
                    <input type="hidden" name="id" value="<?= $usuario['id'] ?>">
                    <button type="submit">Excluir</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
</tbody>

        </table>
    <?php else: ?>
        <p>Nenhum usuário encontrado.</p>
    <?php endif; ?>
</body>
</html>
