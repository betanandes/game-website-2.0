<?php
require 'db.php'; // Conexão com o banco de dados
session_start();

// Verifica se o usuário está logado e autorizado
if (!isset($_SESSION['tipo_usuario']) || $_SESSION['tipo_usuario'] !== 'master') {
    die("Acesso negado.");
}

// Recebe o filtro de pesquisa
$pesquisa = isset($_GET['pesquisa']) ? $_GET['pesquisa'] : '';

// Consulta os logs com filtro por nome, CPF ou ação
$sql = "SELECT l.*, u.nome AS usuario_nome, u.cpf AS usuario_cpf 
        FROM logs l 
        LEFT JOIN usuarios u ON l.usuario_id = u.id 
        WHERE (u.nome LIKE :pesquisa OR u.cpf LIKE :pesquisa OR l.acao LIKE :pesquisa)
        ORDER BY l.data_hora DESC";
$stmt = $pdo->prepare($sql);
$stmt->execute([':pesquisa' => '%' . $pesquisa . '%']);
$logs = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="assets/gamex-favicon.png" type="image/x-icon">
    <title>Logs de Autenticação</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        * {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            background: rgb(254,213,255);
            background: radial-gradient(circle, rgba(254,213,255,1) 18%, rgba(255,255,255,1) 100%);
            color: black;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }
        h1 {
            text-align: center;
            color: #a870eb;
            font-weight: bold;
            margin-top: 5px;
        }
        .container {
            width: 100%;
            max-width: 900px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 5px 5px 8px rgba(0, 0, 0, 0.3);
            padding: 20px;
            margin-top: 20px;
        }
        form {
            margin-bottom: 20px;
            display: flex;
            justify-content: center;
            gap: 10px;
        }
        form input[type="text"] {
            padding: 10px;
            width: 300px;
            border: 2px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }
        form input[type="text"]:focus {
            border: 2px solid #a870eb;
            outline: none;
        }
        form button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            background: rgba(182, 122, 255, 1);
            color: white;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: transform 0.3s, background-color 0.3s;
        }
        form button:hover {
            transform: scale(1.05);
            background: linear-gradient(130deg, rgba(168, 113, 235, 1) 0%, rgba(0, 0, 0, 1) 47%, rgba(182, 122, 255, 1) 100%);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 3px 3px 8px rgba(0, 0, 0, 0.2);
            margin-bottom: 20px;
        }
        table thead {
            background: rgba(182, 122, 255, 1);
            color: white;
            text-transform: uppercase;
        }
        table th, table td {
            padding: 12px 15px;
            text-align: left;
            border: 1px solid #ddd;
        }
        table tbody tr:nth-child(even) {
            background: #f9f9f9;
        }
        table tbody tr:hover {
            background: rgba(182, 122, 255, 0.1);
        }
        a.btn-back {
            display: inline-block;
            padding: 10px 20px;
            background: rgba(182, 122, 255, 1);
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 14px;
            font-weight: bold;
            transition: transform 0.3s, background-color 0.3s;
        }
        a.btn-back:hover {
            transform: scale(1.05);
            background: linear-gradient(130deg, rgba(168, 113, 235, 1) 0%, rgba(0, 0, 0, 1) 47%, rgba(182, 122, 255, 1) 100%);
        }
    </style>
</head>
<body>
    <h1>Logs de Autenticação</h1>
    <div class="container">
        <form action="logs.php" method="GET">
            <input type="text" name="pesquisa" placeholder="Pesquisar por nome, CPF ou ação" value="<?= htmlspecialchars($pesquisa) ?>">
            <button type="submit">Pesquisar</button>
        </form>
        <table>
            <thead>
                <tr>
                    <th>Data</th>
                    <th>Usuário</th>
                    <th>Ação</th>
                    <th>Status 2FA</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($logs as $log): ?>
                    <tr>
                        <td><?= date('d/m/Y H:i', strtotime($log['data_hora'])) ?></td>
                        <td><?= htmlspecialchars($log['usuario_nome']) ?> (<?= htmlspecialchars($log['usuario_cpf']) ?>)</td>
                        <td><?= htmlspecialchars($log['acao']) ?></td>
                        <td><?= ($log['2fa_status'] == '1') ? 'Passou' : 'Não passou' ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a class="btn-back" href="index.php">Voltar para a Home</a>
    </div>
</body>
</html>
