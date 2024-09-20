<?php
session_start(); // Inicia a sessão

// Verifica se a pergunta foi selecionada
if (!isset($_SESSION['pergunta_selecionada'])) {
    header("Location: login.php"); // Redireciona se não houver pergunta
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $resposta_digitada = $_POST['resposta'];

    // Verifica se a resposta inserida é a mesma da pergunta escolhida
    if (strtolower($resposta_digitada) == strtolower($_SESSION['pergunta_selecionada']['resposta'])) {
        // Autenticação bem-sucedida
        // $_SESSION['nome'] = $_SESSION['email_2fa']; 

        // Limpa as sessões temporárias
        unset($_SESSION['pergunta_selecionada']);
        unset($_SESSION['perguntas']);

        // Redireciona para a página principal
        header("Location: index.php");
        exit();
    } else {
        $erro = "Resposta incorreta! Tente novamente.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>2FA</title>
</head>
<body>
    <h1>Verificação de Pergunta de Segurança</h1>

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
