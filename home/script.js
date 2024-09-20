// Toggle Dark Mode
const toggleButton = document.getElementById('dark-mode-toggle');
toggleButton.addEventListener('click', () => {
    document.body.classList.toggle('dark-mode');
});

// Toggle Hamburger Menu
const hamburguer = document.getElementById('hamburguer');
const navLinks = document.getElementById('nav-links');
hamburguer.addEventListener('click', () => {
    navLinks.classList.toggle('active');
});

// Função para filtrar os jogos
document.getElementById('categoria-select').addEventListener('change', function() {
    const categoriaSelecionada = this.value; // Categoria selecionada no filtro
    const cards = document.querySelectorAll('.item'); // Todos os cards de jogos

    // Loop através de todos os cards para filtrar
    cards.forEach(function(card) {
        const categoriaDoJogo = card.getAttribute('data-categoria'); // Categoria do jogo

        // Mostra ou oculta o card com base na categoria selecionada
        if (categoriaSelecionada === 'todos' || categoriaDoJogo === categoriaSelecionada) {
            card.style.display = 'block'; // Mostra o card se a categoria for correspondente ou "todos"
        } else {
            card.style.display = 'none'; // Oculta o card se não corresponder à categoria
        }
    });
});
