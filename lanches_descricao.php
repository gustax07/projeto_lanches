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
    <title>Document</title>
    <style>
        body
        {
            margin-top: 250px;
            
            
        }
    </style>
</head>
<body>
    <?php foreach ($item->ListarPorID() as $i) { ?>
    <div class="row mt-5">
        <div class="col-7">
        <img src="./images/<?=$i['imagem'];?>" height="500px" width="500px">
        </div>
        <div class="col-5">
            <h2><?=$i['nome']?></h2>
            <p><?=$i['descricao']?></p>
            <h1 class="display-6"><?=$i['preco']?></h1>
            <button type="button" class="btn btn-warning">Adicionar ao carrinho</button>

        </div>
        <?php } ?>
</body>
</html>

<!-- finalizar a responsividade desse negócio ai -->