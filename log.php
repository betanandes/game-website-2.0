<?php
require 'db.php'; // Conexão com o banco de dados
session_start();

// Verifica se o usuário está logado e autorizado
if (!isset($_SESSION['tipo_usuario']) || $_SESSION['tipo_usuario'] !== 'master') {
    die("Acesso negado.");
}

function registrarLog($pdo, $usuario_id, $acao, $detalhes = null) {
    $sql = "INSERT INTO logs (usuario_id, acao, detalhes) VALUES (:usuario_id, :acao, :detalhes)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'usuario_id' => $usuario_id,
        'acao' => $acao,
        'detalhes' => $detalhes
    ]);
}


// Consulta os logs
$pesquisa = isset($_GET['pesquisa']) ? $_GET['pesquisa'] : '';
$sql = "SELECT l.*, u.nome AS usuario_nome 
        FROM logs l 
        LEFT JOIN usuarios u ON l.usuario_id = u.id 
        WHERE l.acao LIKE :pesquisa OR u.nome LIKE :pesquisa
        ORDER BY l.data_hora DESC";
$stmt = $pdo->prepare($sql);
$stmt->execute([':pesquisa' => '%' . $pesquisa . '%']);
$logs = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="log.css">
    <title>Logs do Sistema</title>
</head>
<body>
    <h1>Logs do Sistema</h1>
    <form method="GET">
        <input type="text" name="pesquisa" placeholder="Pesquisar por ação ou usuário" value="<?= htmlspecialchars($pesquisa) ?>">
        <button type="submit">Pesquisar</button>
    </form>
    <table border="1">
        <thead>
            <tr>
                <th>Data e Hora</th>
                <th>Usuário</th>
                <th>Ação</th>
                <th>Detalhes</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($logs): ?>
                <?php foreach ($logs as $log): ?>
                    <tr>
                        <td><?= htmlspecialchars($log['data_hora']) ?></td>
                        <td><?= htmlspecialchars($log['usuario_nome'] ?? 'Sistema') ?></td>
                        <td><?= htmlspecialchars($log['acao']) ?></td>
                        <td><?= htmlspecialchars($log['detalhes']) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4">Nenhum log encontrado.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    <a href="index.php">Voltar</a>
</body>
</html>
