<?php
require 'db.php';

$id = $_GET['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $email = $_POST['email'];

    $sql = "UPDATE usuarios SET nome = :nome, email = :email WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['nome' => $nome, 'email' => $email, 'id' => $id]);

    header("Location: index.php");
    exit();
}

$sql = "SELECT * FROM usuarios WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute(['id' => $id]);
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Usuário</title>
</head>
<body>
    <h1>Editar Usuário</h1>
    <form method="POST" action="update.php?id=<?= $usuario['id']; ?>">
        <label for="nome">Nome:</label>
        <input type="text" name="nome" value="<?= $usuario['nome']; ?>" required><br>

        <label for="email">Email:</label>
        <input type="email" name="email" value="<?= $usuario['email']; ?>" required><br>

        <button type="submit">Salvar</button>
    </form>
</body>
</html>
