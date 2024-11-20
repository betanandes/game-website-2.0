<?php
require 'db.php'; // Conexão com o banco de dados
session_start();

$mensagem = null; // Variável para armazenar a mensagem

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $nova_senha = $_POST['nova_senha'];
    $confirmar_senha = $_POST['confirmar_senha'];

    // Verifica se a nova senha tem pelo menos 8 caracteres
    if (strlen($nova_senha) < 8) {
        $mensagem = ['tipo' => 'erro', 'texto' => "A nova senha deve ter pelo menos 8 caracteres."];
    } elseif ($nova_senha !== $confirmar_senha) {
        // Verifica se a nova senha e a confirmação são iguais
        $mensagem = ['tipo' => 'erro', 'texto' => "As senhas não coincidem."];
    } else {
        // Verifica se o e-mail existe no banco de dados
        $sql = "SELECT id FROM usuarios WHERE email = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['email' => $email]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$usuario) {
            $mensagem = ['tipo' => 'erro', 'texto' => "E-mail não encontrado."];
        } else {
            // Atualiza a nova senha no banco de dados
            $nova_senha_hash = password_hash($nova_senha, PASSWORD_DEFAULT);
            $sql_update = "UPDATE usuarios SET senha = :nova_senha WHERE email = :email";
            $stmt_update = $pdo->prepare($sql_update);
            $stmt_update->execute(['nova_senha' => $nova_senha_hash, 'email' => $email]);

            // Define a mensagem de sucesso e redireciona para o login
            // $mensagem = ['tipo' => 'sucesso', 'texto' => " Redirecionando para o login..."];
            $_SESSION['mensagem'] = "Senha alterada com sucesso! Faça login para acessar.";
            header("Location: login.php");
            exit(); // Finaliza o script após o redirecionamento
        }
    }
}
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="alterar_senha.css">
    <link rel="shortcut icon" href="assets/gamex-favicon.png" type="image/x-icon">
    <title>Altere sua Senha</title>
</head>
<body>
    
<div class="form">
    <h1>Altere sua senha</h1>

    <!-- Exibe a mensagem, se existir -->
    <?php if (isset($mensagem)): ?>
        <p style="color: <?= $mensagem['tipo'] === 'erro' ? 'red' : 'green'; ?>;">
            <?= $mensagem['texto']; ?>
        </p>
    <?php endif; ?>

    <form method="POST" action="">
        <label for="email">E-mail:</label>
        <input type="email" id="email" name="email" placeholder="Digite seu e-mail" required>
        
        <label for="nova_senha">Nova Senha:</label>
        <input type="password" id="nova_senha" name="nova_senha" placeholder="Digite sua nova senha" minlength="8" required>
        
        <label for="confirmar_senha">Confirmar Nova Senha:</label>
        <input type="password" id="confirmar_senha" name="confirmar_senha" placeholder="Confirme sua nova senha" minlength="8" required>
        
        <button type="submit">Salvar Alterações</button>
    </form>
</div>


</body>
</html>
