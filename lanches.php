<?php
require_once('./classes/itens.class.php');
$itens = new Itens();
$itens_listar = $itens->Listar();

header('Content-type: text/html; charset=utf-8');

?>

<!doctype html>
<html lang="pt-BR">

<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Hello, world!</title>
</head>

<body>
    
    <div class="container-fluid">

        <div class="row"> <!-- Linha 1 || começo --> <!-- carrossel de imagens -->
            <div class="col-12">
                <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="..." class="d-block w-100" alt="..." style="width: 100%; height: 500px;">
                        </div>
                        <div class="carousel-item">
                            <img src="..." class="d-block w-100" alt="..." style="width: 100%; height: 500px;">
                        </div>
                        <div class="carousel-item">
                            <img src="..." class="d-block w-100" alt="..." style="width: 100%; height: 500px;">
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

        <div class="row" style="gap: 30px; justify-content: space-evenly;"> <!-- Linha 3 || começo --> <!-- modelo dos cards -->
            <?php foreach ($itens_listar as $i) { ?>
                <div class="col-2">
                    <div class="card"
                        style="width: 18rem; border-radius: 50px; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); background-color: #f5f5f5;">
                        <img src="./images/<?= $i['imagem'] ?>" class="card-img-top" alt="..." style="height: 220px; width: 270px;">
                        <div class="card-body">
                            <h5 class="card-title"><?= $i['nome'] ?></h5>
                            <h6>R$ <?= $i['preco'] ?></h6>
                            <p class="card-text"><?= $i['descricao'] ?></p>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div> <!-- Linha 3 || fim -->
    </div>

    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>