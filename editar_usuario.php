<?php
require 'db.php';
session_start();

// Verifica se o usuário está logado e é "master"
if (!isset($_SESSION['tipo_usuario']) || $_SESSION['tipo_usuario'] != 'master') {
    header("Location: login.php");
    exit();
}

// Verifica se o ID do usuário foi passado na URL
if (!isset($_GET['id'])) {
    die("ID do usuário não especificado.");
}

$id = (int)$_GET['id'];

// Consulta os dados do usuário
$sql = "SELECT id, nome, email FROM usuarios WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute(['id' => $id]);
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$usuario) {
    die("Usuário não encontrado.");
}

// Atualiza os dados do usuário
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];

    // Atualiza os dados no banco
    $sql = "UPDATE usuarios SET nome = :nome, email = :email WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':nome' => $nome,
        ':email' => $email,
        ':id' => $id
    ]);

    echo "Usuário atualizado com sucesso!";
    header("Location: consulta_usuarios.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="editar_usuario.css">
    <link rel="shortcut icon" href="assets/gamex-favicon.png" type="image/x-icon">
    <title>Editar Usuário</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap');

        * {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: rgb(254,213,255);
            background: radial-gradient(circle, rgba(254,213,255,1) 18%, rgba(255,255,255,1) 100%);
            color: black;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #a870eb;
            font-weight: bold;
            margin-top: 5px;
        }

        .container {
            width: 100%;
            max-width: 800px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 5px 5px 8px rgba(0, 0, 0, 0.3);
            padding: 20px;
            margin-top: 20px;
            transition: background-color 0.5s ease;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        form label {
            font-size: 14px;
            font-weight: bold;
            color: #5e4b8b;
        }

        form input[type="text"], 
        form input[type="email"] {
            padding: 10px;
            border: 2px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            transition: border 0.3s;
        }

        form input[type="text"]:focus,
        form input[type="email"]:focus {
            border: 2px solid #a870eb;
            outline: none;
        }

        form button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            background: rgba(182, 122, 255, 1);
            color: white;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: transform 0.3s, background-color 0.3s;
        }

        form button:hover {
            transform: scale(1.05);
            background: rgb(168, 113, 235);
            background: linear-gradient(130deg, rgba(168, 113, 235, 1) 0%, rgba(0, 0, 0, 1) 47%, rgba(182, 122, 255, 1) 100%);
        }

        a.btn-back {
            display: inline-block;
            padding: 10px 20px;
            background: rgba(182, 122, 255, 1);
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 14px;
            font-weight: bold;
            transition: transform 0.3s, background-color 0.3s;
            margin-top: 20px;
        }

        a.btn-back:hover {
            transform: scale(1.05);
            background: rgb(168, 113, 235);
            background: linear-gradient(130deg, rgba(168, 113, 235, 1) 0%, rgba(0, 0, 0, 1) 47%, rgba(182, 122, 255, 1) 100%);
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Editar Usuário</h1>
        <form method="POST">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" value="<?= htmlspecialchars($usuario['nome']); ?>" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?= htmlspecialchars($usuario['email']); ?>" required>

            <button type="submit">Salvar</button>
        </form>
        
        <a href="consulta_usuarios.php" class="btn-back">Voltar</a>
    </div>
</body>
</html>
