{
     async function listarCategorias() {
    const catNew = document.getElementById('catNew');
    const urlParams = new URLSearchParams(window.location.search);
    const idAtual = urlParams.get('id'); // Pega o ID da URL se existir

    try {
        const response = await fetch('actions/categorias/listar_categorias.php');
        const dados = await response.json();

        if (dados.status == 'sucesso') {
            let conteudoCategorias = `
                <li class="nav-item">
                    <a class="nav-link todos ${!idAtual ? 'active' : ''}" href="/" onclick="marcarAtivo(this)">
                        Todos
                    </a>
                </li>`;

            dados.lista.forEach(cat => {
                const isActive = (idAtual == cat.id) ? 'active' : '';
                conteudoCategorias += `
                    <li class="nav-item">
                    <a class="nav-link ${isActive}" href="/?id=${cat.id}" onclick="marcarAtivo(this)">
                            ${cat.nome}
                        </a>
                    </li>`;
            });

            catNew.innerHTML = conteudoCategorias;
        }
    } catch (error) {
        console.error("Erro ao listar categorias:", error);
    }
}

function marcarAtivo(elemento) {
    const links = document.querySelectorAll('#catNew .nav-link');
    links.forEach(l => l.classList.remove('active'));
    elemento.classList.add('active');
}

listarCategorias();
}