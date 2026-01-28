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
        img
        {
            max-height: 500px;
            max-width: 500px;
            min-height: 300px;
            min-width: 300px;
            
        }
    </style>
</head>
<body>
    <div class="container">
        <?php foreach ($item->ListarPorID() as $i) { ?>
        <div class="row"> <!-- começo da linha 1 -->

         

            <div class="col-lg-6 ">
                <img src="./images/<?=$i['imagem'];?>">
            </div>

            <div class="col-6">
             <h1><?=$i['nome']?></h1>
             <p><?=$i['descricao']?></p>
             <h1 class="display-6"><?=$i['preco']?></h1>
            </div>

            
        </div> <!-- fim da linha 1 -->

        <div class="row justify-content-md-center">
            <div class="col-12 col-md-auto"> 
                 <button type="button" class="btn btn-warning btn-lg">Adicionar ao carrinho</button>
            </div>
        </div>
        <?php } ?>
    </div>

    
</body>
</html>