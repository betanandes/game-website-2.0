<?php
session_start();
require 'db.php';

$produto_id = $_POST['produto_id'];
$usuario_id = $_SESSION['usuario_id'];
$acao = $_POST['acao'];

// Recupera o carrinho do usuário
$sql = "SELECT id FROM carrinho WHERE usuario_id = :usuario_id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':usuario_id', $usuario_id);
$stmt->execute();
$carrinho = $stmt->fetch();

if ($acao == 'aumentar') {
    $sql = "UPDATE itens_carrinho SET quantidade = quantidade + 1 WHERE carrinho_id = :carrinho_id AND produto_id = :produto_id";
} elseif ($acao == 'diminuir') {
    $sql = "UPDATE itens_carrinho SET quantidade = quantidade - 1 WHERE carrinho_id = :carrinho_id AND produto_id = :produto_id";
} elseif ($acao == 'remover') {
    $sql = "DELETE FROM itens_carrinho WHERE carrinho_id = :carrinho_id AND produto_id = :produto_id";
}

$stmt = $pdo->prepare($sql);
$stmt->bindParam(':carrinho_id', $carrinho['id']);
$stmt->bindParam(':produto_id', $produto_id);
$stmt->execute();

header("Location: carrinho.php");
?>
