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
document.getElementById('categoria-select').addEventListener('change', function () {
    const categoriaSelecionada = this.value;
    const itens = document.querySelectorAll('.jogos-container .item');

    itens.forEach(item => {
        const categoria = item.getAttribute('data-categoria');

        if (categoriaSelecionada === 'todos' || categoria === categoriaSelecionada) {
            item.style.display = 'block';
        } else {
            item.style.display = 'none';
        }
    });
});
