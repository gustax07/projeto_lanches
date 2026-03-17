<?php
// Usar include_once evita erros caso o arquivo já tenha sido chamado antes
include_once('classes/categorias.class.php');
include_once('includes/bootstrap_include.php');
$categorias = new Categorias();
$categorias_listar = $categorias->Listar();

// Verifica qual categoria está selecionada na URL (Ex: index.php?id=2)
$categoria_atual = isset($_GET['id']) ? $_GET['id'] : '';
?>
<head>
     <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="./images/icon_burguer.png">
    <link rel="stylesheet" href="css/nav.css">
    <title>Navegação</title>
</head>
<nav class="categoria-nav navbar navbar-expand-lg shadow-sm">
    
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuResponsivo" aria-controls="menuResponsivo" aria-expanded="false" aria-label="Alternar navegação">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="index.php" title="Ver todo o cardápio"> 🍔 Cardápio</a>
    
    <div class="collapse navbar-collapse" id="menuResponsivo">
        <ul class="navbar-nav d-flex align-items-center justify-content-between">
            
                <li class="nav-item">
                    <a class="nav-link <?= empty($categoria_atual) ? 'active' : '' ?>" href="index.php">
                        Todos
                    </a>
                </li>

                <?php foreach ($categorias_listar as $c) { ?>
                    <li class="nav-item">
                        <a class="nav-link <?= ($categoria_atual == $c['id']) ? 'active' : '' ?>" href="index.php?id=<?= $c['id'] ?>">
                            <?= $c['nome'] ?>
                        </a>
                    </li>
                <?php } ?>

            </ul>
        </div>

   
</nav>