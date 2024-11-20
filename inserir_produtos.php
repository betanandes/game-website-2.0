<?php
require 'db.php'; // Inclua a conexão com o banco de dados

// Lista de produtos
$produtos = [
    ['nome' => 'Elden Ring', 'categoria' => 'RPG', 'preco' => 299.90, 'imagem' => 'assets/produtos/ELDEN-RING.avif'],
    ['nome' => 'Marvel’s Spider-Man 2', 'categoria' => 'Aventura', 'preco' => 349.90, 'imagem' => 'assets/produtos/Marvel\'s Spider-Man 2.avif'],
    ['nome' => 'Black Myth: Wukong', 'categoria' => 'RPG', 'preco' => 299.90, 'imagem' => 'assets/produtos/Black Myth-Wukong.avif'],
    ['nome' => 'Resident Evil Village', 'categoria' => 'Terror', 'preco' => 184.50, 'imagem' => 'assets/produtos/Resident Evil Village.jpeg'],
    ['nome' => 'Dragon Ball', 'categoria' => 'Luta', 'preco' => 349.90, 'imagem' => 'assets/produtos/DRAGON BALL.avif'],
    ['nome' => 'Dead by Daylight', 'categoria' => 'Terror', 'preco' => 149.50, 'imagem' => 'assets/produtos/Dead by Daylight.webp'],
    ['nome' => 'God of War Ragnarök', 'categoria' => 'Aventura', 'preco' => 349.90, 'imagem' => 'assets/produtos/God of War Ragnarök.jpeg'],
    ['nome' => 'Cyberpunk 2077', 'categoria' => 'Ação', 'preco' => 249.90, 'imagem' => 'assets/produtos/Cyberpunk 2077.webp'],
    ['nome' => 'Hogwarts Legacy', 'categoria' => 'RPG', 'preco' => 249.90, 'imagem' => 'assets/produtos/Hogwarts Legacy.webp'],
    ['nome' => 'Mortal Kombat 1', 'categoria' => 'Luta', 'preco' => 249.99, 'imagem' => 'assets/produtos/Mortal Kombat1.avif'],
    ['nome' => 'NARUTO X BORUTO', 'categoria' => 'Luta', 'preco' => 149.95, 'imagem' => 'assets/produtos/NARUTO X BORUTO Ultimate Ninja STORM CONNECTIONS.avif'],
    ['nome' => 'The Last of Us™ Part II', 'categoria' => 'Aventura', 'preco' => 199.50, 'imagem' => 'assets/produtos/The Last of Us™ Part II.avif']
];

foreach ($produtos as $produto) {
    $sql = "INSERT INTO produtos (nome, categoria, preco, imagem) VALUES (:nome, :categoria, :preco, :imagem)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':nome' => $produto['nome'],
        ':categoria' => $produto['categoria'],
        ':preco' => $produto['preco'],
        ':imagem' => $produto['imagem']
    ]);
}

echo "Produtos adicionados com sucesso!";
?>
