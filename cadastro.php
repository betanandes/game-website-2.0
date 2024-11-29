<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Crie sua conta</title>
    <link rel="shortcut icon" href="assets/gamex-favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="cadastro.css">
    <script>
        // Função para limpar os campos do formulário
        function limparCampos() {
            document.getElementById("formCadastro").reset(); 
        }

        // Função para buscar endereço pelo CEP
        document.addEventListener('DOMContentLoaded', () => {
            const cepInput = document.getElementById('cep');
            const enderecoInput = document.getElementById('endereco_completo');

            cepInput.addEventListener('blur', function () {
                const cep = this.value.replace(/\D/g, ''); // Remove caracteres não numéricos

                if (cep.length === 8) {
                    fetch(`https://viacep.com.br/ws/${cep}/json/`)
                        .then(response => response.json())
                        .then(data => {
                            if (!data.erro) {
                                enderecoInput.value = `${data.logradouro}, ${data.bairro}, ${data.localidade} - ${data.uf}`;
                            } else {
                                alert('CEP não encontrado.');
                                enderecoInput.value = '';
                            }
                        })
                        .catch(error => {
                            console.error('Erro ao buscar o CEP:', error);
                            alert('Ocorreu um erro ao buscar o CEP. Tente novamente mais tarde.');
                        });
                } else {
                    alert('CEP inválido. Por favor, insira 8 dígitos.');
                    enderecoInput.value = '';
                }
            });
        });
    </script>
</head>
<body>
    <form method="POST" action="cadastro.php" id="formCadastro">

        <div class="bg-image" color="#4a4a4a;">
            <h1>Crie sua conta</h1>
        </div>

        <div class="input-group">
            <div class="input-box">
                <label for="nome">Nome:</label>
                <input type="text" minlength="15" maxlength="80" name="nome" required>
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
                <input type="text" name="cep" id="cep" required>
            </div>

            <div class="input-box"> 
                <label for="endereco_completo">Endereço Completo:</label>
                <input type="text" name="endereco_completo" id="endereco_completo" required>
            </div>
        </div>

        <div class="input-group">
            <div class="input-box">   
                <label for="login">Login:</label>
                <input type="text" name="login" maxlength="6" required>
                <?php if (isset($erros['login'])): ?>
                    <p style="color: red;"><?= $erros['login']; ?></p>
                <?php endif; ?>
            </div>

            <div class="input-box">   
                <label for="senha">Senha:</label>
                <input type="password" name="senha" required>
                <?php if (isset($erros['senha'])): ?>
                    <p style="color: red;"><?= $erros['senha']; ?></p>
                <?php endif; ?>
            </div>
        </div>

        <div class="input-group">
            <div class="input-box">   
                <label for="confirm_senha">Confirme a Senha:</label>
                <input type="password" name="confirm_senha" required>
                <?php if (isset($erros['confirm_senha'])): ?>
                    <p style="color: red;"><?= $erros['confirm_senha']; ?></p>
                <?php endif; ?>
            </div>
        </div>

        <div class="input-group">
            <div class="input-box">
                <label for="resposta1">Qual o nome de sua mãe?</label>
                <input type="text" name="resposta1" required>
            </div>

            <div class="input-box">
                <label for="resposta2">Qual é o seu CEP?</label>
                <input type="text" name="resposta2" required>
            </div>

            <div class="input-box">
                <label for="resposta3">Qual é sua data de nascimento?</label>
                <input type="date" name="resposta3" required>
            </div>
        </div>

        <div class="input-box">
            <button type="submit">Cadastrar</button>
            <button type="button" onclick="limparCampos()">Limpar</button>
        </div>

    </form>
</body>
</html>
