<?php
// Inicia a sessão para verificar se o usuário está logado
session_start();

// Conectar ao banco de dados (conforme seu arquivo db.php)
require 'db.php'; // Supondo que você tenha um arquivo db.php que gerencia a conexão

// Verificar se o usuário está logado
if (!isset($_SESSION['user_id'])) {
    // Caso o usuário não esteja logado, redireciona para a página de login
    header("Location: login.php");
    exit();
}

// Acessando o perfil do usuário para verificar permissões
$perfil_usuario = $_SESSION['perfil']; // Obtendo o perfil do usuário logado

// Caso o perfil não seja 'master', não deixa acessar a página de logs
if ($perfil_usuario !== 'master') {
    // Se não for 'master', redireciona para a página padrão (por exemplo, dashboard)
    header("Location: dashboard_comum.php");
    exit();
}

// Exemplo de consulta para exibir o log de acessos
$sql = "SELECT * FROM log_acesso ORDER BY data_hora DESC";
$stmt = $pdo->query($sql);
$logs = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Exibir os logs
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Histórico de Log de Acesso</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4;
            padding: 20px;
        }
        h1 {
            text-align: center;
        }
        .log-container {
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .log-entry {
            border: 1px solid #ddd;
            padding: 10px;
            margin-bottom: 10px;
        }
        .log-entry strong {
            color: #333;
        }
        .log-entry p {
            margin: 5px 0;
        }
        .no-logs {
            text-align: center;
            font-style: italic;
            color: #888;
        }
    </style>
</head>
<body>

    <div class="log-container">
        <h1>Histórico de Log de Acesso</h1>

        <?php
        // Verifica se há logs para exibir
        if (count($logs) > 0) {
            // Exibindo os logs
            foreach ($logs as $log) {
                echo "<div class='log-entry'>";
                echo "<strong>Usuário:</strong> " . htmlspecialchars($log['nome_usuario']) . "<br>";
                echo "<strong>Perfil:</strong> " . htmlspecialchars($log['perfil_usuario']) . "<br>";
                echo "<strong>Tentativas de 2FA:</strong> " . htmlspecialchars($log['tentativas_2fa']) . "<br>";
                echo "<strong>Status:</strong> " . htmlspecialchars($log['status']) . "<br>";
                echo "<strong>Data e Hora:</strong> " . htmlspecialchars($log['data_hora']) . "<br>";
                echo "</div>";
            }
        } else {
            // Exibe mensagem caso não haja logs
            echo "<p class='no-logs'>Não há logs registrados.</p>";
        }
        ?>

    </div>

</body>
</html>
