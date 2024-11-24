<?php
session_start(); 

require 'db.php';
require 'functions.php';

// Inicializa o contador de erros, se ainda não estiver definido
if (!isset($_SESSION['tentativas'])) {
    $_SESSION['tentativas'] = 0;
}

// Verifica se a pergunta foi selecionada
if (!isset($_SESSION['pergunta_selecionada'])) {
    $_SESSION['pergunta_selecionada'] = selecionarPerguntaAleatoria();  // Agora vem de functions.php
}

// Lógica principal de verificação e controle de tentativas
if ($_SESSION['tentativas'] < 2) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $resposta_digitada = $_POST['resposta'];

        // Verifica se a resposta inserida é a mesma da pergunta escolhida
        if (strtolower($resposta_digitada) == strtolower($_SESSION['pergunta_selecionada']['resposta'])) {
            // Limpa as sessões temporárias e reseta o contador de tentativas
            unset($_SESSION['pergunta_selecionada']);
            unset($_SESSION['perguntas']);
            $_SESSION['tentativas'] = 0;

            // Use $_SESSION para pegar o ID do usuário após o login
            $usuario_id = $_SESSION['usuario_id'];  // Armazenar o ID do usuário na sessão após o login

            // Registra o log com sucesso no 2FA
            registrarLog($pdo, $usuario_id, 'Tentativa login', 'Usuário logou com sucesso.', 1);

            // Redireciona para a página principal
            header("Location: index.php");
            exit();
        } else {
            // Incrementa o contador de tentativas
            $_SESSION['tentativas']++;
            $erro = "Resposta incorreta! Tentativa {$_SESSION['tentativas']} de 3.";

            // Seleciona uma nova pergunta aleatória
            $_SESSION['pergunta_selecionada'] = selecionarPerguntaAleatoria();  // Agora vem de functions.php

            // Registra o log de falha no 2FA
            registrarLog($pdo, $_SESSION['usuario_id'], 'Tentativa login', 'Resposta incorreta na verificação 2FA.');
        }
    }
} else {
    // Se o número de tentativas atingir 3, redireciona para a página de login
    unset($_SESSION['pergunta_selecionada']);
    unset($_SESSION['perguntas']);
    $_SESSION['tentativas'] = 0; // Reseta tentativas para o próximo login

    // Registra o log de falha por número de tentativas excedido
    registrarLog($pdo, $_SESSION['usuario_id'], 'Tentativa login', 'Número máximo de tentativas excedido.');

    header("Location: login.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="2FA/2fa.css">
    <link rel="shortcut icon" href="assets/gamex-favicon.png" type="image/x-icon">
    <title>2FA</title>
</head>
<body>

<div class="form-container">
    
        <h1>Verificação de Pergunta de Segurança</h1>
        <div class="imagem">
            
            <img src="2FA/midia/Madoka-gif-2FA.gif" alt="Madoka">
        
        </div>
    
    
        <?php if (isset($erro)): ?>
            
            <p style="color: red;"><?= $erro; ?></p>
    
            <?php endif; ?>
    
        <?php if (isset($_SESSION['pergunta_selecionada'])): ?>
       
            <p><?= $_SESSION['pergunta_selecionada']['pergunta']; ?></p>
    
        <?php endif; ?>

    <form method="POST" action="2fa.php">
        <label for="resposta">Resposta:</label>
        <input type="text" name="resposta" required><br>

        <button type="submit">Verificar</button>
    </form>
</body>
</html>
