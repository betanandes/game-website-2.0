<?php
require 'db.php'; //Arquivo que faz conexão com db
session_start(); // Inicia a sessão

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT); // password_hash = função de criptografia no php | PASSWORD_DEFAULT = é um dos métodos de criptografia

    // Perguntas de segurança e suas respostas
    $pergunta1 = "Qual o nome de sua mãe?";
    $resposta1 = $_POST['resposta1'];

    $pergunta2 = "Em que cidade você nasceu?";
    $resposta2 = $_POST['resposta2'];

    $pergunta3 = "Qual é sua data de nascimento?";
    $resposta3 = $_POST['resposta3'];

    // Verifica se o email já está registrado no banco
    $sql = "SELECT * FROM usuarios WHERE email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['email' => $email]);
    $usuario_existente = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario_existente) {
        $_SESSION['erro'] = "O email já está registrado!";
        header("Location: cadastro.php"); // Redireciona de volta para o formulário de cadastro
        exit();
    }

    // Insere o novo usuário com as perguntas e respostas de segurança no banco de dados
    $sql = "INSERT INTO usuarios (nome, email, senha, pergunta1, resposta1, pergunta2, resposta2, pergunta3, resposta3) VALUES (:nome, :email, :senha, :pergunta1, :resposta1, :pergunta2, :resposta2, :pergunta3, :resposta3)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'nome' => $nome, 'email' => $email, 'senha' => $senha,
        'pergunta1' => $pergunta1, 'resposta1' => $resposta1,
        'pergunta2' => $pergunta2, 'resposta2' => $resposta2,
        'pergunta3' => $pergunta3, 'resposta3' => $resposta3
    ]);

    // Armazena uma mensagem de sucesso na sessão
    $_SESSION['mensagem'] = "Cadastro realizado com sucesso! Faça login para acessar.";
    
    // Redireciona o usuário para a página de login
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastre-se</title>
    <link rel="shortcut icon" href="assets/gamex-favicon.png" type="image/x-icon">
</head>
<body>
    <h1>Criar Usuário</h1>

    <?php if (isset($_SESSION['erro'])): ?>
        <p style="color: red;"><?= $_SESSION['erro']; unset($_SESSION['erro']); ?></p>
    <?php endif; ?>

    <form method="POST" action="cadastro.php">
        <label for="nome">Nome:</label>
        <input type="text" name="nome" required><br>

        <label for="email">Email:</label>
        <input type="email" name="email" required><br>

        <label for="senha">Senha:</label>
        <input type="password" name="senha" required><br>

        <!-- Perguntas de Segurança -->
        <label for="pergunta1">Qual o nome de sua mãe?</label>
        <input type="text" name="resposta1" required><br>

        <label for="pergunta2">Em que cidade você nasceu?</label>
        <input type="text" name="resposta2" required><br>

        <label for="pergunta3">Qual é sua data de nascimento?</label>
        <input type="text" name="resposta3" required><br>


        <button type="submit">Cadastrar</button>

    </form>
</body>
</html>
