<div class="lanches">
    <?php

    require_once __DIR__ . '../../vendor/autoload.php';
    use App\Itens;
    use App\Pedidos;
    use App\Pedidos_Itens;

    $idCategoria = isset($_GET['id']) ? (int) $_GET['id'] : null;

    $itens = new Itens();

    $itensCarrinho = [];

    if (isset($_SESSION['usuario'])) {

        $pedido = new Pedidos();
        $pedido->id_usuarios_fk = $_SESSION['usuario']['id'];

        $pedidoAberto = $pedido->BuscarPedidosAbertos();

        if (!empty($pedidoAberto)) {
            $pedidoItens = new Pedidos_Itens();
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
    <script src="/js/lanches.js" defer></script>
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
                                    <img src="images/<?= $item['imagem'] ?>" loading="lazy" style="width: 100%; height: 100%;" class="img-fluid object-fit-cover">
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
     {
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
                btnCarrinho.setAttribute('href', '/meu_carrinho');
            }
        }

        <?php if (!isset($_SESSION['usuario'])) { ?>
            window.addEventListener('load', function() {
                let btnAbrirCarrinho = document.querySelector('.btn-carrinho');
                btnAbrirCarrinho.remove();
            });
        <?php } ?>
     }
    </script>
</div>