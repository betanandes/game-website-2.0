<?php
require 'db.php'; // Arquivo que faz conexão com db
session_start(); // Inicia a sessão

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Captura e sanitiza os dados
    $nome = trim($_POST['nome']);
    $data_nascimento = $_POST['data_nascimento'];
    $sexo = $_POST['sexo'];
    $nome_materno = trim($_POST['nome_materno']);
    $cpf = trim($_POST['cpf']);
    $email = trim($_POST['email']);
    $telefone_celular = trim($_POST['telefone_celular']);
    $telefone_fixo = trim($_POST['telefone_fixo']);
    $cep = trim($_POST['cep']);
    $endereco_completo = trim($_POST['endereco_completo']);
    $login = trim($_POST['login']);
    $senha = $_POST['senha']; 
    $confirm_senha = $_POST['confirm_senha'];

    // Perguntas de segurança e suas respostas
    $resposta1 = trim($_POST['resposta1']);
    $resposta2 = trim($_POST['resposta2']);
    $resposta3 = trim($_POST['resposta3']);

    // Validação dos campos
    $erros = [];

    // Nome entre 15 e 80 caracteres alfabéticos
    if (strlen($nome) < 15 || strlen($nome) > 80 || !preg_match("/^[a-zA-Z\s]+$/", $nome)) {
        $erros['nome'] = "O nome deve conter entre 15 e 80 caracteres alfabéticos.";
    }

    // Validação do CPF (implementação do dígito verificador)
    if (!validarCPF($cpf)) {
        $erros['cpf'] = "CPF inválido.";
    }

    // Verificação do login com exatamente 6 caracteres alfabéticos
    if (strlen($login) != 6 || !preg_match("/^[a-zA-Z]+$/", $login)) {
        $erros['login'] = "O login deve conter exatamente 6 caracteres alfabéticos.";
    }

    //Verificação da senha com exatamente 8 caracteres
    if (strlen($senha) != 8 || strlen($confirm_senha) != 8) {
        $erros['senha'] = "A senha e a confirmação de senha devem ter exatamente 8 caracterexs.";
    }elseif ($senha!==$confirm_senha){
        $erros['confirm_senha'] = "As senhas não coincidem.";
    } else {
        $senha_hash = password_hash($senha, PASSWORD_DEFAULT); // Criptografia da senha
    }
   

    // Verifica se o email já está registrado no banco
    $sql = "SELECT * FROM usuarios WHERE email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['email' => $email]);
    $usuario_existente = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario_existente) {
        $_SESSION['erro'] = "O email já está registrado!";
        header("Location: cadastro.php");
        exit();
    }

    // Se não houver erros, insere os dados no banco de dados
    if (empty($erros)) {
        $sql = "INSERT INTO usuarios (nome, data_nascimento, sexo, nome_materno, cpf, email, telefone_celular, telefone_fixo, cep, endereco_completo, login, senha, pergunta1, resposta1, pergunta2, resposta2, pergunta3, resposta3)
                VALUES (:nome, :data_nascimento, :sexo, :nome_materno, :cpf, :email, :telefone_celular, :telefone_fixo, :cep, :endereco_completo, :login, :senha, :pergunta1, :resposta1, :pergunta2, :resposta2, :pergunta3, :resposta3)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'nome' => $nome,
            'data_nascimento' => $data_nascimento,
            'sexo' => $sexo,
            'nome_materno' => $nome_materno,
            'cpf' => $cpf,
            'email' => $email,
            'telefone_celular' => $telefone_celular,
            'telefone_fixo' => $telefone_fixo,
            'cep' => $cep,
            'endereco_completo' => $endereco_completo,
            'login' => $login,
            'senha' => $senha_hash,
            'pergunta1' => 'Qual o nome de sua mãe?',
            'resposta1' => $resposta1,
            'pergunta2' => 'Qual é o seu CEP?',
            'resposta2' => $resposta2,
            'pergunta3' => 'Qual é sua data de nascimento?',
            'resposta3' => $resposta3
        ]);

        $_SESSION['mensagem'] = "Cadastro realizado com sucesso! Faça login para acessar.";
        header("Location: login.php");
        exit();
    }
}

// Função para validar CPF
function validarCPF($cpf) {
    $cpf = preg_replace('/[^0-9]/', '', $cpf);
    if (strlen($cpf) != 11) return false;

    for ($t = 9; $t < 11; $t++) {
        for ($d = 0, $c = 0; $c < $t; $c++) {
            $d += $cpf[$c] * (($t + 1) - $c);
        }

        $d = ((10 * $d) % 11) % 10;
        if ($cpf[$c] != $d) return false;
    }
    return true;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Crie sua conta</title>
    <link rel="shortcut icon" href="assets/gamex-favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="cadastro.css">
</head>
<body>

    <form method="POST" action="cadastro.php">

<div class="bg-image" color="#4a4a4a;">
    <h1>Crie sua conta</h1>
</div>

    <div class="input-group">
        <div class="input-box">
            <label for="nome">Nome:</label>
            <input type="text" name="nome" required>
            <?php if (isset($erros['nome'])): ?>
                <p style="color: red;"><?= $erros['nome']; ?></p>
            <?php endif; ?>
        </div>

        <div class="input-box">
            <label for="data_nascimento">Data de Nascimento:</label>
            <input type="date" name="data_nascimento">
        </div>
    </div>

    <div class="input-group">
        <div class="input-box">    
            <label for="sexo">Sexo:</label>
            <select name="sexo">
                <option value="Masculino">Masculino</option>
                <option value="Feminino">Feminino</option>
            </select>
        </div>

        <div class="input-box">
            <label for="nome_materno">Nome Materno:</label>
            <input type="text" name="nome_materno">
        </div>
    </div>

    <div class="input-group">
        <div class="input-box"> 
            <label for="cpf">CPF:</label>
            <input type="text" name="cpf" required>
            <?php if (isset($erros['cpf'])): ?>
                <p style="color: red;"><?= $erros['cpf']; ?></p>
            <?php endif; ?>
        </div>    

        <div class="input-box"> 
            <label for="email">Email:</label>
            <input type="email" name="email" required>
            <?php if (isset($erros['email'])): ?>
                <p style="color: red;"><?= $erros['email']; ?></p>
            <?php endif; ?>
        </div>
    </div>    


    <div class="input-group">
        <div class="input-box">   
            <label for="telefone_celular">Telefone Celular:</label>
            <input type="text" name="telefone_celular" placeholder="(+55)XX-XXXXXXXX">
        </div>

        <div class="input-box">   
            <label for="telefone_fixo">Telefone Fixo:</label>
            <input type="text" name="telefone_fixo" placeholder="(+55)XX-XXXXXXXX">
        </div>
    </div>

   <div class="input-group">
        <div class="input-box">      
            <label for="cep">CEP:</label>
            <input type="text" name="cep" required onblur="buscaCEP()">
        </div>

        <div class="input-box">
            <label for="endereco_completo">Endereço Completo:</label>
            <input type="text" name="endereco_completo" id="endereco_completo"> 
        </div>
   </div>

        
   <div class="input-group">
        <div class="input-box">
            <label for="login">Login:</label>
            <input type="text" name="login" required>
            <?php if (isset($erros['login'])): ?>
                <p style="color: red;"><?= $erros['login']; ?></p>
            <?php endif; ?>
        </div>

        <div class="input-box">
            <label for="senha">Senha:</label>
            <input type="password" name="senha" required>
            <?php if (isset($erros['senha'])): ?>
                <p style="color: red;"><?= $erros['nome']; ?></p>
            <?php endif; ?>
        </div>
    </div>


    <div class="input-group">
        <div class="input-box">
            <label for="confirm_senha">Confirmação de Senha:</label>
            <input type="password" name="confirm_senha" required>
            <?php if (isset($erros['confirm_senha'])): ?>
                <p style="color: red;"><?= $erros['confirm_senha']; ?></p>
            <?php endif; ?>
        </div>
    
        <div class="input-box">
            <label for="resposta1">Qual é o nome de sua mãe?</label>
            <input type="text" name="resposta1" required>
        </div>
    </div>

    <div class="input-group">
        <div class="input-box">    
            <label for="resposta2">Qual é o CEP?</label>
            <input type="text" name="resposta2" required>
        </div>

        <div class="input-box">
            <label for="resposta3">Qual é sua data de nascimento?</label>
            <input type="text" name="resposta3" required>
        </div>
    </div>

        <button type="submit">Cadastrar</button>
   
    </form>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        function buscaCEP() {
            var cep = document.querySelector("input[name='cep']").value;
            axios.get('https://viacep.com.br/ws/' + cep + '/json/')
            .then(function(response) {
                document.getElementById("endereco_completo").value = response.data.logradouro + ", " + response.data.bairro + ", " + response.data.localidade + " - " + response.data.uf;
            });
        }
    </script>
</body>
</html>
