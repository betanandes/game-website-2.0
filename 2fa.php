<?php
session_start(); // Inicia a sessão

// Inicializa o contador de erros, se ainda não estiver definido
if (!isset($_SESSION['tentativas'])) {
    $_SESSION['tentativas'] = 0;
}

// Função para selecionar uma nova pergunta aleatória
function selecionarPerguntaAleatoria() {
    if (isset($_SESSION['perguntas']) && !empty($_SESSION['perguntas'])) {
        return $_SESSION['perguntas'][array_rand($_SESSION['perguntas'])];
    } else {
        header("Location: login.php"); // Redireciona se não houver perguntas
        exit();
    }
}

// Verifica se a pergunta foi selecionada
if (!isset($_SESSION['pergunta_selecionada'])) {
    $_SESSION['pergunta_selecionada'] = selecionarPerguntaAleatoria();
}

// Lógica principal de verificação e controle de tentativas
if ($_SESSION['tentativas'] < 2) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $resposta_digitada = $_POST['resposta'];

        // Verifica se a resposta inserida é a mesma da pergunta escolhida
        if (strtolower($resposta_digitada) == strtolower($_SESSION['pergunta_selecionada']['resposta'])) {
            // Autenticação bem-sucedida
            // $_SESSION['nome'] = $_SESSION['email_2fa'];

            // Limpa as sessões temporárias e reseta o contador de tentativas
            unset($_SESSION['pergunta_selecionada']);
            unset($_SESSION['perguntas']);
            $_SESSION['tentativas'] = 0;

            // Redireciona para a página principal
            header("Location: index.php");
            exit();
        } else {
            // Incrementa o contador de tentativas
            $_SESSION['tentativas']++;
            $erro = "Resposta incorreta! Tentativa {$_SESSION['tentativas']} de 3.";

            // Seleciona uma nova pergunta aleatória
            $_SESSION['pergunta_selecionada'] = selecionarPerguntaAleatoria();
        }
    }
} else {
    // Se o número de tentativas atingir 3, redireciona para a página de login
    unset($_SESSION['pergunta_selecionada']);
    unset($_SESSION['perguntas']);
    $_SESSION['tentativas'] = 0; // Reseta tentativas para o próximo login
    header("Location: login.php");
    exit();
}
?>
    

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="2FA/2fa.css">
    <title>2FA</title>
</head>
<body>

<div class="form-container">
    
        <h1>Verificação de Pergunta de Segurança</h1>
        <div class="imagem">
            
            <img src="2FA/midia/image-hatsunemiku.gif" alt="Hatsune Miku">
        
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
