<?php

include('./header.php');

include('./classes/itens.class.php');
$item = new Itens;
$id = $_GET['id'];
$item->id = $id;

$item_descricao = $item->ListarPorID()[0];

$item->id_categoria_fk = $item_descricao['id_categoria_fk'];

$itens_listar = $item->ListarPorCategoria();
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="./images/icon_burguer.png">
    <link rel="stylesheet" href="css/lanches.css">
    <title><?= $item_descricao['nome'] ?></title>
    <style>
        body {
            background-color: #F5F5F5;
        }

        img {
            max-height: 500px;
            max-width: 500px;
        }
    </style>
</head>

<body>
    <div class="container-fluid mt-5">
        <div class="row">
            <div class="d-flex col-md-6 col-sm-12 justify-content-center">
                <img src="./images/<?= $item_descricao['imagem']; ?>">
            </div>
            <div class="col-md-6 col-sm-12">
                <h1 class="fs-1 fw-bold"><?= $item_descricao['nome'] ?></h1>
                <p class="text-muted">By Tasty Burgers</p>
                <h1 class="fs-1 fw-bold">R$<?= $item_descricao['preco'] ?></h1>


                <div class="d-flex col-12 justify-content-start mt-5">
                    <form action="actions/pedido_itens/cadastrar_pedido_itens.php" target="_parent" method="post">

                        <input type="hidden" name="id_item" value="<?= $id ?>">
                        <div class="d-flex align-items-center gap-2 w-100">
                            <button type="submit" class="btn btn-warning">
                                <i class="bi bi-cart-plus"></i> Adicionar ao carrinho
                            </button>
                            <button type="button" class="btn btn-warning"><i class="bi bi-cart-check"></i>Comprar agora</button>

                        </div>
                    </form>


                </div>

                <div class="col-12">
                    <hr>
                    <strong>Descrição:</strong>
                    <p><?= $item_descricao['descricao'] ?></p>
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <hr>
                <h3 class="fs-3 fw-bold">Avaliações</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <hr>
                <h3 class="fs-3 fw-bold mb-5">Sugestões</h3>
            </div>
            <div class="row g-3 justify-content-center">
                <?php foreach ($itens_listar as $i) { ?>
                    <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                        <a href="./lanches_descricao.php?id=<?= $i['id'] ?>">
                            <div class="card h-90">
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
    </div>
    <div style="height: 20px;"></div>
    <?php include("footer.html")?>
    
</body>

</html>