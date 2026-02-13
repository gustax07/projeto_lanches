<?php
require_once('./includes/bootstrap_include.php');
include('./classes/itens.class.php');

$id = $_GET['id'];

$item = new Itens;
$item->id = $id;
$item_descricao = $item->ListarPorID();
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=add_shopping_cart" />
    <title>Document</title>
    <style>
        body {
            margin-top: 250px;
        }

        img {
            max-height: 500px;
            max-width: 500px;
            min-height: 300px;
            min-width: 300px;

        }

        .material-symbols-outlined {
            font-variation-settings:
                'FILL' 0,
                'wght' 400,
                'GRAD' 0,
                'opsz' 48
        }
    </style>
</head>

<body>
    <div class="container">
        <?php foreach ($item->ListarPorID() as $i) { ?>
            <div class="row"> <!-- começo da linha 1 -->



                <div class="col-lg-6 ">
                    <img src="./images/<?= $i['imagem']; ?>">
                </div>

                <div class="col-6">
                    <h1><?= $i['nome'] ?></h1>
                    <p><?= $i['descricao'] ?></p>
                    <h1 class="display-6"><?= $i['preco'] ?></h1>
                </div>


            </div> <!-- fim da linha 1 -->
            <form action="actions/pedido_itens/cadastrar_pedido_itens.php" target="_parent" method="post">
    <input type="hidden" name="id_item" value="<?= $i['id'] ?>">


                <button type="submit" class="btn btn-warning w-100">
                    <span class="material-symbols-outlined">add_shopping_cart</span>
                    Adicionar ao carrinho
                </button>
            </form>

        <?php } ?>
    </div>





</body>

</html>