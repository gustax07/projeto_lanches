<?php
include('classes/categorias.class.php');
include('includes/bootstrap_include.php');

$categorias = new Categorias();
$categorias_listar = $categorias->Listar();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/nav.css">
</head>

<nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <div class="container-fluid">

        <a class="navbar-brand" href="index.php">🍔</a>

        <button class="navbar-toggler" type="button"
            data-bs-toggle="collapse"
            data-bs-target="#menuResponsivo"
            aria-controls="menuResponsivo"
            aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="menuResponsivo">
            <ul class="navbar-nav me-auto mb-2 mb-md-0">

                <?php foreach ($categorias_listar as $c) { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?id=<?= $c['id'] ?>">
                            <?= $c['nome'] ?>
                        </a>
                    </li>
                <?php } ?>

            </ul>
        </div>

    </div>
</nav>

</html>