<?php
require_once('./classes/itens.class.php');
require_once('./classes/pedidos.class.php');
require_once('./classes/pedidos_itens.class.php');
$itens = new Itens();
$itens_listar = $itens->Listar();

header('Content-type: text/html; charset=utf-8');

$itensCarrinho = [];
if (isset($_SESSION['usuario'])) {

    $pedido = new Pedidos();
    $pedido->id_usuarios_fk = $_SESSION['usuario']['id'];
$idUsuario = $_SESSION['usuario']['id'];
    $pedidoAberto = $pedido->BuscarPedidosAbertos();

    if (!empty($pedidoAberto)) {
        $pedidoItens = new Pedido_Itens();
        $pedidoItens->id_pedidos_fk = $pedidoAberto[0]['id'];
        $itensCarrinho = $pedidoItens->ListarPorPedido();
    }
}

print_r($_SESSION);

?>

<!doctype html>
<html lang="pt-BR">

<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=shopping_cart_checkout" />
    <title>Hello, world!</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
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
</style>

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

        <div class="row justify-content-end"> <!-- Linha 2 || começo -->

            <div class="col-3" style="margin: 10px; margin-top:100px; margin-bottom:100px">
                <h1>Lanches</h1>
            </div>

            <div class="col-4" style="margin: 10px; margin-top:100px; margin-bottom:100px">
                <button
                    type="button" data-bs-toggle="modal" data-bs-target="#modalCarrinho" data-id="<?=$_SESSION['pedido_aberto'] ?> ?>" class="btn btn-warning btn-lg"><span class="material-symbols-outlined">
                        shopping_cart_checkout
                    </span> Finalizar
                </button>
            </div>

        </div> <!-- Linha 2 || final -->

        <div class="row row g-4 justify-content-center" style="gap: 30px; justify-content: space-evenly;"> <!-- Linha 3 || começo --> <!-- modelo dos cards -->
            <?php foreach ($itens_listar as $i) { ?>
                <div class="col col-xl-2">
                    <a href="./lanches_descricao.php?id=<?= $i['id'] ?>">
                        <div class="card"
                            style="width: 18rem; border-radius: 50px; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); background-color: #f5f5f5;">
                            <img src="./images/<?= $i['imagem'] ?>" class="card-img-top card-img-fixed" alt="..." style="height: 200px; width: 250px;">
                            <div class="card-body">
                                <h5 class="card-title"><?= $i['nome'] ?></h5>
                                <h6>R$ <?= $i['preco'] ?></h6>
                                <p class="card-text"><?= $i['descricao'] ?></p>
                            </div>
                        </div>
                    </a>
                </div>
            <?php } ?>
        </div> <!-- Linha 3 || fim -->
    </div>
    <div class="antesDoFooter" style="margin-top: 60px "> </div>




<!-- modal -->
    <div class="modal fade" id="modalCarrinho" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">🛒 Meu Carrinho</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                
                    <div id="modalBody"></div>
                    <?php if (empty($itensCarrinho)) { ?>
                        <p class="text-center text-muted">Carrinho vazio</p>
                    <?php } else { ?>

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
    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script>
        window.addEventListener("message", function(e) {
            const iframe = document.getElementById("footerIframe");
            iframe.style.height = e.data + "px";
        });


    </script>
</body>

</html>