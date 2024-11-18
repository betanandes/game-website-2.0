<?php
require 'db.php'; // Conexão com o banco de dados
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $nova_senha = $_POST['nova_senha'];

    // Verifica se o email existe no banco de dados
    $sql = "SELECT * FROM usuarios WHERE email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['email' => $email]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario) {
        // Criptografa a nova senha
        $senha_hashed = password_hash($nova_senha, PASSWORD_DEFAULT);

        // Atualiza a senha no banco de dados
        $sql_update = "UPDATE usuarios SET senha = :nova_senha WHERE email = :email";
        $stmt_update = $pdo->prepare($sql_update);
        $stmt_update->execute(['nova_senha' => $senha_hashed, 'email' => $email]);

        $_SESSION['mensagem'] = "Senha alterada com sucesso!";
        header("Location: login.php");
        exit();
    } else {
        $erro = "E-mail não encontrado!";
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
    
    <h1>Altere sua Senha</h1>
    
    <?php if (isset($erro)): ?>
        <p style="color: red;"><?= $erro; ?></p>
    <?php endif; ?>

    <form method="POST" action="alterar_senha.php">
        <label for="email">E-mail:</label>
        <input type="email" id="email" name="email" required>
        
        <label for="nova_senha">Nova Senha:</label>
        <input type="password" id="nova_senha" name="nova_senha" required>
        
        <button type="submit">Alterar Senha</button>
    </form>
</body>
</html>
