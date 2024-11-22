<?php
require 'db.php'; // Arquivo que faz a conexão com o banco de dados
session_start(); // Inicia a sessão

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Verifica o usuário no banco de dados
    $sql = "SELECT * FROM usuarios WHERE email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['email' => $email]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verifica se o usuário existe e se a senha está correta
if ($usuario && password_verify($senha, $usuario['senha'])) {
    // Armazena o email, nome e o tipo de usuário na sessão
    $_SESSION['email_2fa'] = $email;
    $_SESSION['nome'] = $usuario['nome']; // Armazenando o nome do usuário
    $_SESSION['tipo_usuario'] = $usuario['tipo_usuario']; // Armazenando o tipo de usuário (master ou comum)
    
    $_SESSION['perguntas'] = [
        ['pergunta' => $usuario['pergunta1'], 'resposta' => $usuario['resposta1']],
        ['pergunta' => $usuario['pergunta2'], 'resposta' => $usuario['resposta2']],
        ['pergunta' => $usuario['pergunta3'], 'resposta' => $usuario['resposta3']],
    ];

    // Escolhe uma pergunta aleatória para 2FA
    $pergunta_escolhida = $_SESSION['perguntas'][array_rand($_SESSION['perguntas'])];
    $_SESSION['pergunta_selecionada'] = $pergunta_escolhida;

    // Função para registrar log
    function registrarLog($pdo, $usuario_id, $acao, $detalhes = null) {
        $sql = "INSERT INTO logs (usuario_id, acao, detalhes) VALUES (:usuario_id, :acao, :detalhes)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'usuario_id' => $usuario_id,
            'acao' => $acao,
            'detalhes' => $detalhes
        ]);
    }

    // Registra o log de login bem-sucedido
    registrarLog($pdo, $usuario['id'], 'Login realizado', 'Usuário logou com sucesso.');

    // Verifica o tipo de usuário e redireciona conforme necessário
    if ($_SESSION['tipo_usuario'] == 'master') {
        // Redireciona para a página do administrador (ou outra página para master)
        header("Location: index.php");
    } else {
        // Redireciona para a página principal para usuários comuns
        header("Location: 2fa.php");
    }
    exit();
} else {
    $erro = "Email ou senha incorretos!";
}

}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Entrar</title>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
     <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" href="assets/gamex-favicon.png" type="image/x-icon">
</head>
<body>

    <div class="form">
    
    <!-- Exibe a mensagem de sucesso ao se cadastrar -->
    <?php if (isset($_SESSION['mensagem'])): ?>
        <p style="color: green;"><?= $_SESSION['mensagem']; unset($_SESSION['mensagem']); ?></p>
    <?php endif; ?>

    <!-- unset($_SESSION[' ']) é para evitar que seja exibida novamente ao recarregar a página -->

    <!-- Exibe mensagem de erro caso ocorra -->
    <?php if (isset($erro)): ?>
        <p style="color: red;"><?= $erro; ?></p>
    <?php endif; ?>

        <form method="POST" action="login.php" id="form">
            <div class="header">
                <div class="switch">
                    
                    <h1>Entrar</h1>
                    
                    <img id="theme-toggle" src="midia/light-mode-icon.gif" alt="Switch to dark mode">
                
                </div>
            
            </div>
        

            <div class="input-box">

                <input type="email" placeholder="E-mail" name="email" required>
                <div id="login-error" class="error"></div>

            </div>
            
            <div class="input-box">

                <input type="password" placeholder="Senha" name="senha" required>
                <div id="senha-error" class="error"></div>
            

            </div>
            

            <div class="create">

                <p><a href="alterar_senha.php">Esqueceu sua senha? Clique aqui para alterar.</a></p>
                <p><a href="cadastro.php">Não possui um login? Cadastre-se!</a></p>

            </div>

            <div class="entrar">

                <button>Entrar</button><br>
                <a href="index.php">Voltar à página inicial</p>

            </div>

        
        </form>


    </div>

    <script src="js/script.js"></script>

</body>
</html>
