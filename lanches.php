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

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" />

    <title>Lanches</title>
    <style>
    ::-webkit-scrollbar {
        width: 2px;
    }

    ::-webkit-scrollbar-track {
        background: transparent;
    }

    ::-webkit-scrollbar-thumb {
        background: rgba(160, 160, 160, 0.9);
        border-radius: 10px;
    }

    ::-webkit-scrollbar-thumb:hover {
        background: rgba(140, 140, 140, 0.6);
    }

    body {
        overflow-x: hidden;
    }

    a {
        text-decoration: none;
        color: #222;
    }

    .card {
        transition: 0.7s;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .card:hover {
        transform: scale(1.1);
        border: 1px solid #E9A652;

    }

    .card:active {
        transform: scale(0.8);
        transition: 0.7s;
    }

    a:hover {
        color: #E9A652;
    }

    .material-symbols-outlined {
        font-variation-settings:
            'FILL' 0,
            'wght' 400,
            'GRAD' 0,
            'opsz' 48
    }
    .modal {
    z-index: 2000 !important;
}

.modal-backdrop {
    z-index: 1990 !important;
}
.modal-dialog {
    margin-top: 120px;
}

</style>
</head>

<body style="margin: 0px; border: none; padding: 0px;">
    <div class="container-fluid" style="margin: 0px; border: none; padding: 0px;">
        <div style="background-color: black; height: 100px; width: 100%;"> </div>
        

<div class="row"> <!-- Linha 1 || começo --> <!-- carrossel de imagens -->
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
            <button
                type="button"
                data-bs-toggle="modal"
                data-bs-target="#modalCarrinho"
                class="btn btn-warning btn-lg">
                <span class="material-symbols-outlined">shopping_cart_checkout</span>
                Finalizar
            </button>
        </div>
    </div>

    <div class="row g-4 justify-content-center">

        <?php foreach ($itens_listar as $i) { ?>
            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">
                <a href="./lanches_descricao.php?id=<?= $i['id'] ?>" class="text-decoration-none">
                    <div class="card h-100">
                        <img src="./images/<?= $i['imagem'] ?>" class="card-img-top" style="height:200px; object-fit:cover;">
                        <div class="card-body">
                            <h5><?= $i['nome'] ?></h5>
                            <p class="text-muted">R$ <?= number_format($i['preco'], 2, ',', '.') ?></p>
                            <p><?= $i['descricao'] ?></p>
                        </div>
                    </div>
                </a>
            </div>
        <?php } ?>

    </div>
</div>

<!-- MODAL CARRINHO -->
<div class="modal fade" id="modalCarrinho" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
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

<?php include('./footer.html'); ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
