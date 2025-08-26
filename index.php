<?php

require 'db.php';

$sql = "SELECT * FROM usuarios";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Inicia a sessão
session_start(); 

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>GameX</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="shortcut icon" href="assets/gamex-favicon.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"> 
</head>
<body>

    <!-- Navbaaaaar -->
 
    <header>
        <nav>
            <div class="logo">
                <img src="assets/gamex-logo-original2.png" alt="">
            </div>
            <div class="nav-container">
                <ul id="nav-links" class="nav-links" style="margin-top: 10px; margin-right: 40px;">
                    <li>
                        <a href="error/error.html">Novidades</a>
                    </li>
                    <li>
                        <a href="#ofertas">Ofertas</a>
                    </li>
                    <li>
                        <a href="#servicos-assinatura">Assinaturas</a>
                    </li>
                    <li>
                        <a href="#contato">Contato</a>
                    </li>
                    <?php if (isset($_SESSION['tipo_usuario']) && $_SESSION['tipo_usuario'] == 'master'): ?>
                    <li>
                        <a href="consulta_produtos.php">Produtos</a>
                    </li>

                    <li>
                        <a href="consulta_usuarios.php">Usuários</i></a>
                    </li>

                    <li>
                        <a href="MER/mer.html">MER</a>
                    </li>
                    <li>
                        <a href="log.php">LOG</a>
                    </li>

                    <?php endif; ?>
                </ul>

                <div class="nav-actions">
                    <form action="buscar_jogo.php" method="GET" id="search-form" class="search-form">
                        <input type="text" placeholder="Pesquisar jogos..." id="search-bar" class="search-bar" name="query" required style="margin-right: 10px;">
                        <a href="error/error.html" class="search-link" style="color: white; font-weight: 600; text-decoration: none;">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        </a>
                    </form>
                    <?php if (isset($_SESSION['nome'])): ?> 
                        <p class="user-greeting" style="color: white; font-family: 'Poppins'; font-weight: 600; text-decoration: none; margin-left: 30px">Olá, <?= htmlspecialchars($_SESSION['nome']); ?>!</p>
                        <a href="logout.php" class="logout-link" style="color: white; font-weight: 500; text-decoration: none; margin-right: 30px;">Sair</a>
                    <?php else: ?>
                        <div class="auth-buttons">
                            <a href="login.php" class="btn login">Login</a>
                            <a href="cadastro.php" class="btn cadastro">Cadastre-se</a>
                        </div>
                    <?php endif; ?>
                </div>
                
                <!-- Carrinho -->
                <div class="cart-container">
                    <button class="btn btn-primary position-relative" id="cart-button">
                        <i class="fas fa-shopping-cart"></i> Carrinho
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="cart-count">
                            0
                        </span>
                    </button>
                </div>

                <div class="hamburguer" id="hamburguer">
                    ☰
                </div>
            </div>
        </nav>
    </header>

    <!--Modal Carrinho -->
    <div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cartModalLabel">Seu Carrinho</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <ul class="list-group" id="cart-items">
                        <li class="list-group-item">Seu carrinho está vazio.</li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-custom">Finalizar Compra</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Carrossel -->

    <div class="carousel slide" id="carouselDemo" data-bs-wrap="true" data-bs-ride="carousel" data-bs-interval="2000">

<div class="carousel-inner">

    <div class="carousel-item active">
        <img src="assets/banner/stone.png" class="w-100" alt="" style="width: 80%; max-height: 400px; object-fit: cover; margin: 0 auto;">
    </div>

    <div class="carousel-item">
        <img src="assets/banner/horizon.png" class="w-100" alt="" style="width: 80%; max-height: 400px; object-fit: cover; margin: 0 auto;">
    </div>
    
    <div class="carousel-item">
        <img src="assets/banner/assassins.webp" class="w-100" alt="" style="width: 80%; max-height: 400px; object-fit: cover; margin: 0 auto;">
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
    <?php
    // Consulta para obter categorias únicas
    $sql = "SELECT DISTINCT categoria FROM produtos";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $categorias = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($categorias as $categoria): ?>
        <option value="<?= htmlspecialchars($categoria['categoria']) ?>">
            <?= htmlspecialchars(ucfirst($categoria['categoria'])) ?>
        </option>
    <?php endforeach; ?>
</select>

</section>

    <!-- Catálogo de Jogos -->
    <section class="catalogo" id="ofertas">
        <div id="catalogo-jogos" class="jogos-container">
            <?php
            $sql = "SELECT * FROM produtos"; 
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($produtos as $produto): ?>
                <div class="item" data-categoria="<?= htmlspecialchars($produto['categoria']) ?>">
                    <img src="<?= htmlspecialchars($produto['imagem']) ?>" alt="<?= htmlspecialchars($produto['nome']) ?>">
                    <h3><?= htmlspecialchars($produto['nome']) ?></h3>
                    <p>R$<?= number_format($produto['preco'], 2, ',', '.') ?></p>
                    <button class="btn comprar" data-id="<?= $produto['id'] ?>" data-name="<?= htmlspecialchars($produto['nome']) ?>" data-price="<?= $produto['preco'] ?>">Comprar</button>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

        <!-- Assinaturas -->

        <section id="servicos-assinatura" class="servicos">
    <h2 class="titulo">Serviços de Assinatura</h2>
    <div class="planos">
        <div class="plano basico">
            <h3>Básico</h3>
            <p class="preco">R$ 278,90/ano</p>
            <ul>
                <li><i class="fa-solid fa-gifts"></i> Jogos mensais</li>
                <li><i class="fa-solid fa-users"></i> Modo multijogador online</li>
                <li><i class="fa-solid fa-tags"></i> Descontos exclusivos</li>
            </ul>
            <button class="btn assinar" role="button">Assinar</button>
        </div>
        <div class="plano premium">
            <h3>Premium</h3>
            <p class="preco">R$ 475,90/ano</p>
            <ul>
                <li><i class="fa-solid fa-gifts"></i> Jogos mensais</li>
                <li><i class="fa-solid fa-users"></i> Modo multijogador online</li>
                <li><i class="fa-solid fa-tags"></i> Descontos exclusivos</li>
                <li><i class="fa-solid fa-cloud"></i> Armazenamento em nuvem</li>
                <li><i class="fa-solid fa-box-open"></i> Conteúdo exclusivo</li>
            </ul>
            <button class="btn assinar" role="button">Assinar</button>
        </div>
        <div class="plano supremo">
            <h3>Supremo</h3>
            <p class="preco">R$ 538,90/ano</p>
            <ul>
                <li><i class="fa-solid fa-gifts"></i> Jogos mensais</li>
                <li><i class="fa-solid fa-users"></i> Modo multijogador online</li>
                <li><i class="fa-solid fa-tags"></i> Descontos exclusivos</li>
                <li><i class="fa-solid fa-cloud"></i> Armazenamento em nuvem</li>
                <li><i class="fa-solid fa-box-open"></i> Conteúdo exclusivo</li>
                <li><i class="fa-solid fa-images"></i> Catálogo de jogos</li>
                <li><i class="fa-solid fa-gamepad"></i> Experimentação de jogos</li>
            </ul>
            <button class="btn assinar" role="button">Assinar</button>
        </div>
    </div>
</section>

<!-- Avaliações -->
<section class="avaliacoes">
        <h2>Avaliações da Loja</h2>
    
        <div id="comments" class="comments-flex">
            <div class="comment">
                <img src="assets/icons/s2.jpeg" alt="Choi Jungeun" class="comment-avatar">
                <div class="comment-content">
                    <p class="comment-text">"Ótima loja, recomendo!"</p>
                    <p class="comment-author">- Choi Jungeun</p>
                </div>
            </div>
            <div class="comment">
                <img src="assets/icons/saebi.jpeg" alt="Jeong Saebi" class="comment-avatar">
                <div class="comment-content">
                    <p class="comment-text">"Excelente variedade de jogos e os preços são ótimos!"</p>
                    <p class="comment-author">- Jeong Saebi</p>
                </div>
            </div>
            <div class="comment">
                <img src="assets/icons/natty.jpeg" alt="Natty" class="comment-avatar">
                <div class="comment-content">
                    <p class="comment-text">"Site bem fácil de dialogar e a compra é simples de se fazer."</p>
                    <p class="comment-author">- Natty</p>
                </div>
            </div>
            <div class="comment">
                <img src="assets/icons/ningning.jpeg" alt="NingNing" class="comment-avatar">
                <div class="comment-content">
                    <p class="comment-text">"Super fácil de comprar, trâmite excelente."</p>
                    <p class="comment-author">- Ning Ning</p>
                </div>
            </div>


        </div>
 
    </section>
    
    

    <!-- Footer -->

    <footer>

    <section id ="contato"></section>

        <div class="footerLeft">
            <div class="footerMenu">
                <h1 class="fMenuTitle">Sobre Nós</h1>
                <ul class="fList">
                <a href="error/error.html" style="text-decoration: none;"><li class="fListItem">Empresa</li></a> 
                <a href="error/error.html" style="text-decoration: none;"><li class="fListItem">Contato</li></a>
                <a href="error/error.html" style="text-decoration: none;"><li class="fListItem">Lojas</li></a>
                </ul>
            </div>

            <div class="footerMenu">
                <h1 class="fMenuTitle">Links Úteis</h1>
                <ul class="fList">
                <a href="error/error.html" style="text-decoration: none;"><li class="fListItem">Suporte</li></a>
                <a href="error/error.html" style="text-decoration: none;"><li class="fListItem">Reembolso</li></a>
                <a href="error/error.html" style="text-decoration: none;"><li class="fListItem">Feedback</li></a>    
                </ul>
            </div>

            <div class="footerMenu">
                <h1 class="fMenuTitle">Categorias</h1>
                <ul class="fList">
                    <a href="#ofertas" style="text-decoration: none;"><li class="fListItem">Ação</li></a>
                    <a href="#ofertas" style="text-decoration: none;"><li class="fListItem">Aventura</li></a>
                    <a href="#ofertas" style="text-decoration: none;"><li class="fListItem">Luta</li></a>
                    <a href="#ofertas" style="text-decoration: none;"><li class="fListItem">RPG</li></a>
                    <a href="#ofertas" style="text-decoration: none;"><li class="fListItem">Terror</li></a>
          
                </ul>
            </div>
        </div>
        <div class="footerRight">

            <div class="footerRightMenu">
                <h1 class="fMenuTitle">Siga-nos</h1>
                <div class="fIcons">
                    <a href="https://www.linkedin.com/in/roberta-fernandes-a067b9167/">
                        <img src="assets/icons/linkedin.png" alt="" class="fIcon">
                    </a>
                    <a href="https://github.com/betanandes">
                        <img src="assets/icons/github.png" alt="" class="fIcon">
                    </a>
                    <a href="https://www.instagram.com/robertanands/">
                        <img src="assets/icons/instagram.png" alt="" class="fIcon">
                    </a>
                </div>
            </div>
            <div class="footerRightMenu">
                <p>&copy; 2024 GameX. Todos os direitos reservados aos alunos UNISUAM.</p>
            </div>
        </div>
    
    </footer>

    <button id="dark-mode-toggle">Dark Mode</button>

    <script src="home/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Script do Carrinho -->
    <script>
        let cart = [];
        const cartButton = document.getElementById('cart-button');
        const cartItems = document.getElementById('cart-items');
        const cartCount = document.getElementById('cart-count');

        function updateCart() {
            cartItems.innerHTML = '';
            if (cart.length === 0) {
                cartItems.innerHTML = '<li class="list-group-item">Seu carrinho está vazio.</li>';
            } else {
                cart.forEach((item, index) => {
                    cartItems.innerHTML += `
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            ${item.name} - R$${item.price.toFixed(2)}
                            <div>
                                <button class="btn btn-sm btn-danger" onclick="removeFromCart(${index})">-</button>
                                <span class="mx-2">${item.quantity}</span>
                                <button class="btn btn-sm btn-success" onclick="addToCart(${item.id}, '${item.name}', ${item.price})">+</button>
                            </div>
                        </li>`;
                });
            }
            cartCount.textContent = cart.reduce((total, item) => total + item.quantity, 0);
        }

        function addToCart(id, name, price) {
            const existingItem = cart.find(item => item.id === id);
            if (existingItem) {
                existingItem.quantity += 1;
            } else {
                cart.push({ id, name, price, quantity: 1 });
            }
            updateCart();
        }

        function removeFromCart(index) {
            cart[index].quantity -= 1;
            if (cart[index].quantity === 0) {
                cart.splice(index, 1);
            }
            updateCart();
        }

        document.querySelectorAll('.btn.comprar').forEach(button => {
            button.addEventListener('click', () => {
                const id = parseInt(button.getAttribute('data-id'));
                const name = button.getAttribute('data-name');
                const price = parseFloat(button.getAttribute('data-price'));
                addToCart(id, name, price);
            });
        });

        cartButton.addEventListener('click', () => {
            const cartModal = new bootstrap.Modal(document.getElementById('cartModal'));
            cartModal.show();
        });
    </script>
</body>
</html>
