<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}



require_once('./classes/itens.class.php');
require_once('./classes/pedidos.class.php');
require_once('./classes/pedidos_itens.class.php');

include('./includes/sweet_alert2_include.php');


$idCategoria = isset($_GET['id']) ? (int) $_GET['id'] : null;

$itens = new Itens();

$pagina = max(1, (int)($_GET['pagina'] ?? 1));
$itensPorPagina = 24;

if ($idCategoria) {
    $itens->id_categoria_fk = $idCategoria;
    $itens_listar = $itens->ListarPorCategoria($pagina, $itensPorPagina);
    $totalPaginas = $itens->QuantidadePaginas($itensPorPagina);
} else {
    $itens_listar = $itens->Listar($pagina, $itensPorPagina);
    $totalPaginas = $itens->QuantidadePaginas($itensPorPagina);
}

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
    <title>Lanches</title>
</head>

<body style="margin: 0px; border: none; padding: 0px;">
    <div class="container-fluid d-flex justify-content-center align-items-center" style="padding: 0px; margin: 0px;">
        <div class="col p-0">
            <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="./images/banner_1_burguer.png" class="d-block w-100 banner-img" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="./images/banner_2_burguer.png" class="d-block w-100 banner-img" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="./images/banner_3_burguer.png" class="d-block w-100 banner-img" alt="...">
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
    </div>

    <div class="container-fluid">

        <div class="row justify-content-between align-items-center my-5">
            <div class="col">
                <h1>Cardápio</h1>
            </div>
        </div>

        <div class="row g-4 justify-content-center">
            <?php foreach ($itens_listar as $i) { ?>

                <div class="col-6 col-md-4 col-lg-3 col-xl-2">

                    <a style="text-decoration: none; display: block; height: 100%;" href="./lanches_descricao.php?id=<?= $i['id'] ?>">

                        <div class="card h-100 produto-card">

                            <div class="produto-img-container">
                                <img src="./images/<?= (!empty($i['imagem']) && file_exists("./images/" . $i['imagem'])) ? $i['imagem'] : "icon_burguer.png" ?>" class="produto-img" alt="<?= $i['nome'] ?>">
                            </div>

                            <div class="card-body p-3 d-flex flex-column">
                                <h5 class="produto-titulo"><?= $i['nome'] ?></h5>
                                <span class="produto-preco">R$ <?= number_format($i['preco'], 2, ',', '.') ?></span>

                                <p class="produto-descricao mt-auto text-truncate"><?= $i['descricao'] ?></p>
                            </div>

                        </div>

                    </a>

                </div>

            <?php } ?>
        </div>

    </div>

    <!-- MODAL CARRINHO -->
    <div class="modal fade" id="modalCarrinho" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog scrollable ">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title"><i class="bi bi-bag-plus-fill"></i> Meu Carrinho</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <?php foreach ($itensCarrinho as $item) {
                        if (empty($item)) { ?>
                            <p>Seu carrinho está vazio.</p>
                        <?php break;
                        } ?>
                        <div class="d-flex align-items-center mb-3 border-bottom pb-2">


                            <img src="./images/<?= $item['imagem'] ?>" width="80" class="zrounded">

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

                <div class="p-2">
                    <button class="btn btn-success w-100 text-white" id="btnCarrinho"> 
                        <a href="finalizar_pedido.php" style="color: white; text-decoration: none;">
                            Finalizar Pedido
                        </a></button>
                </div>

            </div>
        </div>
    </div>
    <script>
        const itens = <?php echo json_encode($itensCarrinho) ?>;
        let btnCarrinho = document.getElementById('btnCarrinho');

        function verificarCarrinho() {

            if (itens === 0) {
                btnCarrinho.disabled = true;
            } else {
                btnCarrinho.disabled = false;
            }
        }

        <?php if (!isset($_SESSION['usuario'])) { ?>
        window.addEventListener('load', function()  {
            let btnAbrirCarrinho = document.querySelector('.btn-carrinho');
            btnAbrirCarrinho.remove();
        });
        <?php } ?>
        
    </script>

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

</body>

</html>