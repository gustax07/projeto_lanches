<div class="lanches">
    <?php

    require_once('classes/itens.class.php');
    require_once('classes/pedidos.class.php');
    require_once('classes/pedidos_itens.class.php');


    $idCategoria = isset($_GET['id']) ? (int) $_GET['id'] : null;

    $itens = new Itens();

    $itensCarrinho = [];

    if (isset($_SESSION['usuario'])) {

        $pedido = new Pedidos();
        $pedido->id_usuarios_fk = $_SESSION['usuario']['id'];

        $pedidoAberto = $pedido->BuscarPedidosAbertos();

        if (!empty($pedidoAberto)) {
            $pedidoItens = new Pedido_Itens();
            $pedidoItens->id_pedidos_fk = $pedidoAberto[0]['id'];
            $itensCarrinho = $pedidoItens->ListarPorPedido();
        }
    }

    function Porcentagem($preco_original, $preco_promocional)
    {
        $resultado = $preco_original - $preco_promocional;
        $porcentagem = ($resultado / $preco_original) * 100;
        return round($porcentagem, 0);
    }
    ?>
    <div class="header-backgroud" style="height: 150px;"></div>
    <div class="col-auto mt-0 p-0 mx-0" style="background-color: #e3e0e0;">
        <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active d-flex justify-content-center">
                    <img src="images/banner_1_burguer.png" loading="lazy" class="img-fluid">
                </div>
                <div class="carousel-item d-flex justify-content-center">
                    <img src="images/banner_2_burguer.png" loading="lazy" class="img-fluid">
                </div>
                <div class="carousel-item d-flex justify-content-center">
                    <img src="images/banner_3_burguer.png" loading="lazy" class="img-fluid">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>

    <div class="container-fluid mt-5">
        <div id="cards-pedidos" class="row justify-content-center">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>

    <!-- MODAL CARRINHO -->
    <div class="modal fade" data-bs-backdrop="true" id="modalCarrinho" tabindex="-1" aria-labelledby="modalCarrinhoLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title"><i class="bi bi-bag-plus-fill"></i> Meu Carrinho</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <?php if (count($itensCarrinho) == 0) { ?>
                        <p>Seu carrinho está vazio.</p>
                        <?php } else {
                        foreach ($itensCarrinho as $item) {     ?>
                            <div class="d-flex align-items-center border-bottom pb-2">
                                <div class="mx-2" style="width: 80px; height: 80px;">
                                    <img src="./images/<?= $item['imagem'] ?>" loading="lazy" style="width: 100%; height: 100%;" class="img-fluid object-fit-cover">
                                </div>
                                <div class="flex-grow-1">
                                    <strong><?= $item['nome'] ?></strong><br>
                                    Quantidade: <?= $item['quantidade'] ?><br>
                                    Preço: <?php if ($item['preco_promocional'] > 0): ?>
                                    <span class="text-decoration-line-through">R$ <?= number_format($item['preco'], 2, ',', '.') ?></span> - <span class="text-danger">R$ <?= number_format($item['preco_promocional'], 2, ',', '.') ?></span>
                                    <?php else: ?>
                                        R$ <?= number_format($item['preco'], 2, ',', '.') ?>
                                    <?php endif; ?>
                                </div>

                                <div>
                                    <strong>
                                        R$ <?= number_format($item['total'], 2, ',', '.') ?>
                                    </strong>

                                    <form action="actions/pedido_itens/remover_predidos_itens.php" method="post">
                                        <input type="hidden" name="id_pedido" value="<?= $pedidoAberto[0]['id'] ?>">

                                        <input type="hidden" name="id_item" value="<?= $item['id'] ?>">
                                        <button type="submit" class="btn btn-sm btn-danger">Remover</button>
                                    </form>
                                </div>
                            </div>
                    <?php }
                    } ?>
                </div>

                <div class="p-2 border-top">
                    <a id="btnCarrinho" class="btn btn-success w-100 text-white" onclick="fecharModal();">
                        Finalizar Pedido
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div style="clear: both; margin-bottom: 50px;"></div>


    <!-- paginador -->
    <nav style="display:flex; justify-content:center;">
        <ul class="pagination">

            <?php if ($pagina > 1): ?>
                <li class="page-item">
                    <a class="page-link" href="?pagina=<?= $pagina - 1 ?>">Anterior</a>
                </li>
            <?php endif; ?>

            <?php
            $inicio = max(1, $pagina - 2);
            $fim = min($totalPaginas, $pagina + 2);

            if ($inicio > 1) {
                echo '<li class="page-item"><a class="page-link" href="?pagina=1">1</a></li>';
                if ($inicio > 2) {
                    echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
                }
            }

            for ($i = $inicio; $i <= $fim; $i++):
            ?>

                <li class="page-item <?= $i == $pagina ? 'active' : '' ?>">
                    <a class="page-link" href="?pagina=<?= $i ?>">
                        <?= $i ?>
                    </a>
                </li>

            <?php endfor; ?>

            <?php
            if ($fim < $totalPaginas) {
                if ($fim < $totalPaginas - 1) {
                    echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
                }
                echo '<li class="page-item"><a class="page-link" href="?pagina=' . $totalPaginas . '">' . $totalPaginas . '</a></li>';
            }
            ?>

            <?php if ($pagina < $totalPaginas): ?>
                <li class="page-item">
                    <a class="page-link" href="?pagina=<?= $pagina + 1 ?>">Próximo</a>
                </li>
            <?php endif; ?>

        </ul>
    </nav>


    <div style="clear: both; margin-bottom: 50px;"></div>

    <!-- botao carrinho -->
    <button
        type="button"
        data-bs-toggle="modal"
        data-bs-target="#modalCarrinho"
        class="btn-carrinho"
        onclick="verificarCarrinho()">

        <i class="bi bi-bag-plus-fill"></i> <span>Meu carrinho</span>

        <?php if (count($itensCarrinho) > 0): ?>
            <span class="badge-carrinho">
                <?= count($itensCarrinho) ?>
            </span>
        <?php endif; ?>

    </button>
    <script>
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
                        <a href="pedido.php?id-produto=${item.id}" class="text-decoration-none text-dark" >
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

        window.carregarItens = async function() {
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

        const itens = <?php echo json_encode($itensCarrinho) ?>;
        const btnCarrinho = document.getElementById('btnCarrinho');

        function verificarCarrinho() {
            if (itens == 0) {
                btnCarrinho.removeAttribute('href')
                btnCarrinho.style.opacity = 0.5;
                btnCarrinho.style.cursor = 'not-allowed';
            } else {
                btnCarrinho.style.opacity = 1;
                btnCarrinho.style.cursor = 'pointer';
                btnCarrinho.setAttribute('href', 'finalizar_pedido.php');
            }
        }

        <?php if (!isset($_SESSION['usuario'])) { ?>
            window.addEventListener('load', function() {
                let btnAbrirCarrinho = document.querySelector('.btn-carrinho');
                btnAbrirCarrinho.remove();
            });
        <?php } ?>
    </script>
</div>