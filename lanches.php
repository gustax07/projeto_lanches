<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once('./classes/itens.class.php');
require_once('./classes/pedidos.class.php');
require_once('./classes/pedidos_itens.class.php');

$itens = new Itens();
$itens_listar = $itens->Listar();

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
?>

<!doctype html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./css/lanches.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" />
    <title>Lanches</title>
</head>

<body style="margin: 0px; border: none; padding: 0px;">
    <div class="container-fluid" style="margin-top : 0px; border: none; padding: 0px;">
        <div class="w-100 p-0"> <!-- Linha 1 || começo --> <!-- carrossel de imagens -->
            <div class="col-12" style="padding: 0px;">
                <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="./images/banner_1_burguer.png" class="d-block w-100" alt="..." style="width: 100%; max-height: 1000px; border-radius: 0 0 25% 25%;">
                        </div>
                        <div class="carousel-item">
                            <img src="./images/banner_2_burguer.png" class="d-block w-100" alt="..." style="width: 100%; max-height: 1000px; border-radius: 0 0 25% 25%;">
                        </div>
                        <div class="carousel-item">
                            <img src="./images/banner_3_burguer.png" class="d-block w-100" alt="..." style="width: 100%; max-height: 1000px; border-radius: 0 0 25% 25%;">
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
        </div> <!-- Linha 1 || final -->


        <div class="container-fluid">

            <div class="row justify-content-between align-items-center my-5">
                <div class="col">
                    <h1>Lanches</h1>
                </div>

                <div class="col text-end">
                    <button type="button" data-bs-toggle="modal" data-bs-target="#modalCarrinho" class="btn btn-warning btn-lg position-relative">
                        <span class="material-symbols-outlined">shopping_cart_checkout</span>
                        Finalizar

                        <?php if (count($itensCarrinho) > 0): ?>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                <?= count($itensCarrinho) ?>
                                <span class="visually-hidden">itens no carrinho</span>
                            </span>
                        <?php endif; ?>
                    </button>
                </div>
            </div>

            <div class="row g-3 justify-content-center">
                <?php foreach ($itens_listar as $i) { ?>
                    <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                        <a style="text-decoration: none;" href="./lanches_descricao.php?id=<?= $i['id'] ?>">
                            <div class="card h-100">
                                <img src="./images/<?= $i['imagem'] ?>" class="card-img-top">
                                <div class="card-body p-2 p-md-3">
                                    <span class="card-title-custom"><?= $i['nome'] ?></span>
                                    <p class="text-muted small mb-1">R$ <?= number_format($i['preco'], 2, ',', '.') ?></p>
                                    <p class="card-description"><?= $i['descricao'] ?></p>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php } ?>
            </div>

        </div>

        <!-- MODAL CARRINHO -->
        <div class="modal fade " id="modalCarrinho" tabindex="-1">
            <div class="modal-dialog modal-lg modal-dialog scrollable ">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title">🛒 Meu Carrinho</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">



                        <?php foreach ($itensCarrinho as $item) { ?>
                            <div class="d-flex align-items-center mb-3 border-bottom pb-2">


                                <img src="./images/<?= $item['imagem'] ?>" width="80" class="me-3 rounded">

                                <div class="flex-grow-1">
                                    <strong><?= $item['nome'] ?></strong><br>
                                    Quantidade: <?= $item['quantidade'] ?><br>
                                    Preço: R$ <?= number_format($item['preco'], 2, ',', '.') ?>
                                </div>

                                <div>
                                    <strong>
                                        R$ <?= number_format($item['preco'] * $item['quantidade'], 2, ',', '.') ?>
                                    </strong>

                                    <form action="actions/pedido_itens/remover_predidos_itens.php" method="post">
                                        <input type="hidden" name="id_pedido" value="<?= $pedidoAberto[0]['id'] ?>">

                                        <input type="hidden" name="id_item" value="<?= $item['id'] ?>">
                                        <button type="submit" class="btn btn-sm btn-danger">Remover</button>
                                    </form>
                                </div>

                            </div>
                        <?php } ?>



                    </div>

                    <div class="modal-footer">
                        <a href="finalizar_pedido.php" class="btn btn-success w-100">
                            Finalizar Pedido
                        </a>
                    </div>

                </div>
            </div>
        </div>

        <div style="clear: both; margin-bottom: 50px;"></div>



        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js">
        </script>



</body>

</html>