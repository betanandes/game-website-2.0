<?php
// Função para selecionar uma nova pergunta aleatória
function selecionarPerguntaAleatoria() {
    if (isset($_SESSION['perguntas']) && !empty($_SESSION['perguntas'])) {
        return $_SESSION['perguntas'][array_rand($_SESSION['perguntas'])];
    } else {
        header("Location: login.php");
        exit();
    }
}

// Função para registrar log
function registrarLog($pdo, $usuario_id, $acao, $detalhes = null, $two_fa_status = 0) {
    // Se o usuario_id for inválido, passa NULL
    if (is_null($usuario_id)) {
        $usuario_id = NULL;  // Aqui, passamos NULL para o banco de dados
    }

    // Prepara a consulta para inserir o log
    $sql = "INSERT INTO logs (usuario_id, acao, detalhes, 2fa_status) VALUES (:usuario_id, :acao, :detalhes, :two_fa_status)";
    $stmt = $pdo->prepare($sql);

    // Executa a consulta de inserção
    $stmt->execute([
        'usuario_id' => $usuario_id,  // Passa NULL se o login falhou
        'acao' => $acao,
        'detalhes' => $detalhes,
        'two_fa_status' => $two_fa_status
    ]);
}


?>
