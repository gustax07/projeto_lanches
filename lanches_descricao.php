<?php

include('./header.php');
include("./nav.php");
include('./classes/itens.class.php');
$item = new Itens;
$id = $_GET['id'];
$item->id = $id;

$item_descricao = $item->ListarPorID()[0];

$item->id_categoria_fk = $item_descricao['id_categoria_fk'];

$itens_listar = $item->ListarPorCategoria();
$limit = 7;
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

        a {
            text-decoration: none !important;
        }

        @media (max-width: 768px) {
            img {
                max-width: 100%;
                max-height: 100%;
            }
        }



        .img-destaque {
            width: 100%;
            max-width: 420px;
            height: 420px;

            border-radius: 25px;
            overflow: hidden;

            position: relative;

            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.25);
            background: #000;
        }

        .img-destaque img {
            width: 100%;
            height: 100%;
            object-fit: cover;

            transition: transform 0.5s ease;
        }

        .img-destaque:hover img {
            transform: scale(1.08);
        }

        .img-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;

            padding: 20px;

            background: linear-gradient(to top, rgba(0, 0, 0, 0.7), transparent);
        }

        .badge-img {
            background: #ff7b00;
            color: white;

            padding: 6px 12px;
            border-radius: 20px;

            font-size: 12px;
            font-weight: bold;
        }

        .img-destaque::before {
            content: "";
            position: absolute;
            inset: 0;
            border-radius: 25px;

            background: linear-gradient(135deg, rgba(255, 123, 0, 0.3), transparent);
            z-index: 1;
        }

        .img-overlay {
            z-index: 2;
        }
    </style>
</head>

<body>
    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-md-6 col-sm-12 d-flex justify-content-center align-items-center">

                <div class="img-destaque">
                    <img src="./images/<?= $item_descricao['imagem']; ?>" alt="<?= $item_descricao['nome'] ?>">

                    <div class="img-overlay">
                        <span class="badge-img">🔥 Destaque</span>
                    </div>
                </div>

            </div>
            <div class="col-md-6 col-sm-12">
                <h1 class="fs-1 fw-bold"><?= $item_descricao['nome'] ?></h1>
                <p class="text-muted">By Tasty Burgers</p>
                <h1 class="fs-1 fw-bold">R$<?= $item_descricao['preco'] ?></h1>


                <div class="d-flex col-12 justify-content-start mt-5">
                    <form action="actions/pedido_itens/cadastrar_pedido_itens.php" target="_parent" method="post">
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <input type="number" name="quantidade" value="1" min="1" max="99" class="form-control text-center" style="width: 80px;">
                        </div>
                        <input type="hidden" name="id_item" value="<?= $id ?>">
                        <div class="d-flex align-items-center gap-2 w-100">
                            <button type="submit" class="btn btn-warning">
                                <i class="bi bi-cart-plus"></i> Adicionar ao carrinho
                            </button>
                            <!-- <button type="button" class="btn btn-warning"><i class="bi bi-cart-check"></i>Comprar agora</button> -->

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
                <h3 class="fs-3 fw-bold mb-5">Sugestões</h3>
            </div>
            <div class="row g-4 justify-content-center">
            </div>
            <?php foreach ($itens_listar as $i) {
                $limit--;
                if ($limit == 0) break; //para o loop quando o limite for atingido (6) 
            ?>

                <div class="col-6 col-md-4 col-lg-3 col-xl-2">

                    <a style="text-decoration: none; display: block; height: 100%;" href="./lanches_descricao.php?id=<?= $i['id'] ?>">

                        <div class="card h-100 produto-card">

                            <div class="produto-img-container">
                                <img src="./images/<?= $i['imagem'] ?>" class="produto-img" alt="<?= $i['nome'] ?>">
                            </div>

                            <div class="card-body p-3 d-flex flex-column ">
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
    <div style="height: 20px;"></div>
    <?php include("footer.php") ?>

</body>

</html>