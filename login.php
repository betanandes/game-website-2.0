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
     // Armazena o email e as perguntas de segurança na sessão
        $_SESSION['email_2fa'] = $email;
        $_SESSION['nome'] = $usuario['nome']; // Armazenando o nome do usuário
        
        $_SESSION['perguntas'] = [
            ['pergunta' => $usuario['pergunta1'], 'resposta' => $usuario['resposta1']],
            ['pergunta' => $usuario['pergunta2'], 'resposta' => $usuario['resposta2']],
            ['pergunta' => $usuario['pergunta3'], 'resposta' => $usuario['resposta3']],
     ];

        // Escolhe uma pergunta aleatória
        $pergunta_escolhida = $_SESSION['perguntas'][array_rand($_SESSION['perguntas'])];
        $_SESSION['pergunta_selecionada'] = $pergunta_escolhida;
        
        // Redireciona para a página principal
        header("Location: 2fa.php"); 
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
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="login/css/style.css">
</head>
<body>


    <!-- <h1>Login</h1>
    
    
    
    <form method="POST" action="login.php">
        <label for="email">Email:</label>
        <input type="email" name="email" required><br>

        <label for="senha">Senha:</label>
        <input type="password" name="senha" required><br>

        <button type="submit">Login</button>
    </form> -->


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
                    
                    <h1>Login</h1>
                    
                    <img id="theme-toggle" src="login/midia/light-mode-icon.gif" alt="Switch to dark mode">
                
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

                <p><a href="cadastro.php">Não possui um login? Cadastre-se!</a></p>


            </div>

            <div class="entrar">

                <button><a href="#">INSERT COIN</a></button>

            </div>


            <p class="or"> ━━━━━━━━━━━━ OR ━━━━━━━━━━━━ </p>
        
        </form>
    
        <div class="google">
            
            <button> <img src="login/midia/Google Logo.svg" alt="googlelogo">
               
               <a href="https://www.google.com/intl/pt-BR/account/about/" target="_self">
            
                <p>Continue with Google</p>
            
            </a> 
            
            </button>
        
        </div>


        <div class="microsoft">
           
            <button> <img src="login/midia/Microsoft Logo.svg" alt="microsoftlogo">
               
                <a href="https://account.microsoft.com/account?lang=pt-br" target="_self">

                    <p>Continue with Microsoft Account</p>

                </a>
            
            </button>
        
        </div>


    </div>

    <script src="login/js/script.js"></script>

</body>
</html>
