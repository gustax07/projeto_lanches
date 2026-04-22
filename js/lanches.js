{

    function fecharModal() {
        const modal = document.getElementById('modalCarrinho');
        const modalElement = bootstrap.Modal.getInstance(modal);
        modalElement.hide();
    }

    let todosOsItens = [];
    window.indexAtual = 1;
    const LIMITE_POR_PAGINA = 24;
    //listar por categoria atrves da URL 
    async function carregarCategoria() {
        const url = new URL(window.location.href);
        const id = url.searchParams.get('id');

        try {
            const response = await fetch('actions/pedido_itens/listar_por_categoria.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    id_categoria: id
                }),
            });
            const data = await response.json();
            if (data.status == 'sucesso') {
                todosOsItens = data.lista;

                renderCards();
                indexAtual++;
                verificarBotaoCarregarMais(todosOsItens.length);
            } else {
                verificarBotaoCarregarMais(0);
                alert(data.message);
            }
        } catch (error) {
            console.error("Erro ao buscar lanches:", error);
        }
    }

    function carregarCategoriaOuItens() {
        const url = new URL(window.location.href);
        const id = url.searchParams.get('id');

        if (id) {
            carregarCategoria();
        } else {
            carregarItens();
        }
    }

    function renderCards() {
        const cards = document.getElementById('cards-pedidos');
        const spinner = document.querySelector('.spinner-border');

        if (spinner) {
            cards.innerHTML = ``;
        }
        todosOsItens.forEach(item => {

            let htmlPreco = '';

            if (item.preco_promocional && item.preco_promocional > 0) {
                htmlPreco = `
                            <div class="produto-preco">
                            <span class="text-muted text-decoration-line-through me-2">R$ ${item.preco}</span>
                            <span class="text-danger fw-bold">R$ ${item.preco_promocional}</span>
                            </div>`;
            } else {
                htmlPreco = `
                            <div class="produto-preco">
                            <span class="fw-bold">R$ ${item.preco}</span>
                            </div>`;
            }
            const cardHTML = `
                        <div class="col-6 col-md-4 col-lg-3 col-xl-2 mb-3">
                        <a href="/pedido?id-produto=${item.id}" class="text-decoration-none text-dark" >
                        <div class="produto-card shadow-sm h-100">
                        <div class="produto-img-container">
                        <img src="images/${item.imagem}" class="produto-img img-fluid" alt="${item.nome}" loading="lazy">
                        </div>
                        <div class="card-body p-2 d-flex flex-column">
                        <h5 class="produto-titulo fs-6">${item.nome}</h5>
                        
                        ${htmlPreco}
                        
                        <p class="produto-descricao mt-auto text-truncate small">${item.descricao}</p>
                        </div>
                        </div>
                        </a>
                        </div>`;
            cards.insertAdjacentHTML('beforeend', cardHTML);
        });
    }

    window.carregarItens = async function () {

        try {
            const response = await fetch('actions/lanches/listar_lanches.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    pagina: indexAtual
                }),
            });
            const data = await response.json();
            if (data.status == 'sucesso') {
                todosOsItens = data.lista;
                renderCards();
                indexAtual++;
                verificarBotaoCarregarMais(todosOsItens.length);
            } else {
                verificarBotaoCarregarMais(0);
            }
        } catch (error) {
            console.error("Erro ao buscar lanches:", error);
        }
    }
    
    window.onload = carregarCategoriaOuItens();

    async function verificarBotaoCarregarMais(pagina) {
        let btnArea = document.getElementById('area-btn-carregar');

        if (!btnArea) {
            document.getElementById('cards-pedidos').insertAdjacentHTML('afterend', `
        <div id="area-btn-carregar" class="col-12 text-center mt-4 mb-5"></div>`);
            btnArea = document.getElementById('area-btn-carregar');
        }

        if (pagina == LIMITE_POR_PAGINA) {
            btnArea.innerHTML = `<button class="btn btn-outline-primary" onclick="carregarItens()">Carregar mais lanches</button>`;
        } else {
            btnArea.innerHTML = `<p class="text-muted">Você chegou ao fim do cardápio.</p>`;
        }
    }
}
