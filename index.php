<?php

require 'db.php';

$sql = "SELECT * FROM usuarios";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

session_start(); // Inicia a sessão

// if (!isset($_SESSION['nome'])) {
//     // Se o usuário não estiver logado, redireciona para a página de login
//     header("Location: login.php");  // Redireciona para a página de login se não estiver logado
//     exit();
// }

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>GameX</title>
    <link rel="stylesheet" href="home/styles.css">
    <link rel="shortcut icon" href="assets/gamex-favicon.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"> 
    <!-- Serve para linkar o css do bootstrap mais facilmente. -->
</head>
<body>
    <!-- <h1>Bem-vindo ao sistema</h1> -->

    <header>
        <nav>
            <div class="logo">
                <img src="assets/gamex-logo-2.png" alt="">
            </div>
            <div class="nav-container">
                <ul id="nav-links" class="nav-links">
                    <li><a href="#">Início</a></li>
                    <li><a href="#">Jogos</a></li>
                    <li><a href="#">Carrinho</a></li>
                    <li><a href="#">Contato</a></li>
                </ul>
                <div class="nav-actions">
     
                    <input type="text" placeholder="Pesquisar jogos..." class="search-bar">

                <?php if (isset($_SESSION['nome'])): ?> 
        
                    <!-- Mostra o nome do usuário e botão de logout -->
                    <p>Olá, <?= $_SESSION['nome']; ?>!</p>
                    <a href="logout.php">Sair</a>
    
                <?php else: ?>
                <!-- Mostra o botão de login -->
                <a href="login.php">
                    <button class="btn login">Login</button>
                </a>
                <a href="cadastro.php">
                    <button class="btn cadastro">Cadastro</button>
                </a>
                <?php endif; ?>

                <!-- <a href="login.php">
                    <button class="btn login">Login</button>
                </a> -->
  
                </div>
                <div class="hamburguer" id="hamburguer">
                    ☰
                </div>
            </div>
        </nav>
    </header>

       <!-- Carrossel -->

       <div class="carousel slide" id="carouselDemo" data-bs-wrap="true" data-bs-ride="carousel" data-bs-interval="3000">

<div class="carousel-inner">

    <div class="carousel-item active">
        <img src="assets/Design sem nome/gta-banner.png" class="w-100" alt="">
    </div>

    <div class="carousel-item">
        <img src="assets/Design sem nome/stardew-banner.png" class="w-100" alt="">
    </div>
        
    <div class="carousel-item">
        <img src="assets/Design sem nome/stone-banner.png" class="w-100" alt="">
    </div>

</div>

<button class="carousel-control-prev" 
type="button"
data-bs-target="#carouselDemo" data-bs-slide="prev">
    <span class="carosel-control-prev-icon"></span>
</button>

<button class="carousel-control-next" type="button"
data-bs-target="#carouselDemo" data-bs-slide="next">
<span class="carosel-control-next-icon"></span>
</button>


</div>

<!-- Filtro -->

<section class="filtro-jogos">
<label for="categoria-select">Filtrar por:</label>
<select id="categoria-select">
    <option value="todos">Todos</option>
    <option value="acao">Ação</option>
    <option value="aventura">Aventura</option>
    <option value="rpg">RPG</option>
</select>
</section>

<!-- Catálogo de Jogos -->

<section class="catalogo">
<div id="catalogo-jogos" class="jogos-container">
<div class="item" data-categoria="acao">
    <img src="jogo1.jpg" alt="Jogo 1">
    <h3>Jogo 1</h3>
    <p>R$ 59,90</p>
    <button class="btn comprar" onclick="">Comprar</button>
</div>
<div class="item">
    <img src="jogo2.jpg" alt="Jogo 2">
    <h3>Jogo 2</h3>
    <p>R$ 79,90</p>
    <button class="btn comprar">Comprar</button>
</div>

<div class="item">
    <img src="jogo3.jpg" alt="Jogo 3">
    <h3>Jogo 3</h3>
    <p >R$ 79,90</p>
    <button class="btn comprar">Comprar</button>
</div>

<div class="item">
    <img src="jogo4.jpg" alt="Jogo 4">
    <h3>Jogo 4</h3>
    <p>R$ 79,90</p>
    <button class="btn comprar">Comprar</button>
</div>

<div class="item">
    <img src="jogo5.jpg" alt="Jogo 5">
    <h3>Jogo 5</h3>
    <p>R$ 79,90</p>
    <button class="btn comprar">Comprar</button>
</div>

<div class="item">
    <img src="jogo6.jpg" alt="Jogo 6">
    <h3>Jogo 6</h3>
    <p>R$ 79,90</p>
    <button class="btn comprar">Comprar</button>
</div>

<div class="item">
    <img src="jogo7.jpg" alt="Jogo 7">
    <h3>Jogo 7</h3>
    <p >R$ 79,90</p>
    <button class="btn comprar">Comprar</button>
</div>

<div class="item">
    <img src="jogo8.jpg" alt="Jogo 8">
    <h3>Jogo 8</h3>
    <p>R$ 79,90</p>
    <button class="btn comprar">Comprar</button>
</div>

<div class="item">
    <img src="jogo9.jpg" alt="Jogo 9">
    <h3>Jogo 9</h3>
    <p>R$ 79,90</p>
    <button class="btn comprar">Comprar</button>
</div>

<div class="item">
    <img src="jogo10.jpg" alt="Jogo 10">
    <h3>Jogo 10</h3>
    <p>R$ 79,90</p>
    <button class="btn comprar">Comprar</button>
</div>

<!-- <div class="item">
    <img src="jogo11.jpg" alt="Jogo 11">
    <h3>Jogo 11</h3>
    <p>R$ 79,90</p>
    <button class="btn comprar">Comprar</button>
</div>

<div class="item">
    <img src="jogo12.jpg" alt="Jogo 12">
    <h3>Jogo 12</h3>
    <p>R$ 79,90</p>
    <button class="btn comprar">Comprar</button>
</div> -->
</div>
<!-- Adicione os outros jogos aqui -->
</section>

<section class="avaliacoes">
<h2>Avaliações da Loja</h2>

<!-- Área para exibir comentários em colunas -->
<div id="comments" class="comments-flex">
    <div class="comment">
        <img src="colaborador1.jpg" alt="Choi Jungeun" class="comment-avatar">
        <div class="comment-content">
            <p class="comment-text">"Ótima loja, recomendo!"</p>
            <p class="comment-author">- Choi Jungeun</p>
        </div>
    </div>
    <div class="comment">
        <img src="colaborador2.jpg" alt="Jeong Saebi" class="comment-avatar">
        <div class="comment-content">
            <p class="comment-text">"Excelente atendimento e entrega rápida."</p>
            <p class="comment-author">- Jeong Saebi</p>
        </div>
    </div>
    <div class="comment">
        <img src="colaborador2.jpg" alt="Natty" class="comment-avatar">
        <div class="comment-content">
            <p class="comment-text">"Excelente atendimento e entrega rápida."</p>
            <p class="comment-author">- Natty</p>
        </div>
    </div>
    <div class="comment">
        <img src="colaborador2.jpg" alt="NingNing" class="comment-avatar">
        <div class="comment-content">
            <p class="comment-text">"Excelente atendimento e entrega rápida."</p>
            <p class="comment-author">- Ning Ning</p>
        </div>
    </div>


</div>

</section>


<!-- Footer -->

<footer>
<p>&copy; 2024 GameX. Todos os direitos reservados aos alunos UNISUAM.</p>
</footer>

<button id="dark-mode-toggle">Dark Mode</button>

<script src="home/script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Serve para linkar o JS do bootstrap mais facilmente. -->
</body>
</html>
