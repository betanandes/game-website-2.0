<?php
require 'db.php'; // Conexão com o banco de dados
session_start();

// Verifica se o usuário está logado e é "master"
if (!isset($_SESSION['tipo_usuario']) || $_SESSION['tipo_usuario'] != 'master') {
    header("Location: login.php");
    exit();
}

// Verifica se o ID do usuário foi fornecido
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];

    // Exclui o usuário do banco de dados
    $sql = "DELETE FROM usuarios WHERE id = :id AND tipo_usuario = 'comum'";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $id]);

    // Redireciona de volta para a página de consulta
    header("Location: consulta_usuarios.php");
    exit();
} else {
    header("Location: consulta_usuarios.php");
    exit();
}
?>
