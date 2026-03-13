<?php
// Usar include_once evita erros caso o arquivo já tenha sido chamado antes
include_once('classes/categorias.class.php');

$categorias = new Categorias();
$categorias_listar = $categorias->Listar();

// Verifica qual categoria está selecionada na URL (Ex: index.php?id=2)
$categoria_atual = isset($_GET['id']) ? $_GET['id'] : '';
?>

<nav class="navbar navbar-expand-lg categoria-nav sticky-top">
    <div class="container"> <a class="navbar-brand" href="index.php" title="Ver todo o cardápio">🍔 Cardápio</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuResponsivo" aria-controls="menuResponsivo" aria-expanded="false" aria-label="Alternar navegação">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="menuResponsivo">
            <ul class="navbar-nav">
                
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

    </div>
</nav>