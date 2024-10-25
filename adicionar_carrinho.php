<?php
session_start();
require 'db.php';

$produto_id = $_POST['produto_id']; // O ID do produto enviado via formulário
$usuario_id = $_SESSION['usuario_id']; // ID do usuário logado (você pode ajustar conforme seu sistema de login)

// Verifica se o usuário já tem um carrinho
$sql = "SELECT id FROM carrinho WHERE usuario_id = :usuario_id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':usuario_id', $usuario_id);
$stmt->execute();
$carrinho = $stmt->fetch();

if (!$carrinho) {
    // Cria um novo carrinho se não existir
    $sql = "INSERT INTO carrinho (usuario_id) VALUES (:usuario_id)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':usuario_id', $usuario_id);
    $stmt->execute();
    $carrinho_id = $pdo->lastInsertId(); // Pega o ID do carrinho criado
} else {
    $carrinho_id = $carrinho['id'];
}

// Verifica se o produto já está no carrinho
$sql = "SELECT id, quantidade FROM itens_carrinho WHERE carrinho_id = :carrinho_id AND produto_id = :produto_id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':carrinho_id', $carrinho_id);
$stmt->bindParam(':produto_id', $produto_id);
$stmt->execute();
$item = $stmt->fetch();

if ($item) {
    // Aumenta a quantidade se o produto já estiver no carrinho
    $nova_quantidade = $item['quantidade'] + 1;
    $sql = "UPDATE itens_carrinho SET quantidade = :quantidade WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':quantidade', $nova_quantidade);
    $stmt->bindParam(':id', $item['id']);
    $stmt->execute();
} else {
    // Adiciona o produto ao carrinho
    $sql = "INSERT INTO itens_carrinho (carrinho_id, produto_id, quantidade) VALUES (:carrinho_id, :produto_id, 1)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':carrinho_id', $carrinho_id);
    $stmt->bindParam(':produto_id', $produto_id);
    $stmt->execute();
}

header("Location: carrinho.php"); // Redireciona para o carrinho atualizado
?>
