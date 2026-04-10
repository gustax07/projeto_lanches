<?php
include_once('./classes/categorias.class.php');
$categorias = new Categorias();
$categorias_listar = $categorias->Listar();

// Verifica qual categoria está selecionada na URL (Ex: index.php?id=2)
$categoria_atual = isset($_GET['id']) ? $_GET['id'] : '';
?>
<link rel="stylesheet" href="./css/nav.css">

<nav class="categoria-nav navbar navbar-expand-lg shadow-sm">
    
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuResponsivo" aria-controls="menuResponsivo" aria-expanded="false" aria-label="Alternar navegação">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="/projeto_lanches/" title="Ver todo o cardápio"> 🍔 Cardápio</a>
    
    <div class="collapse navbar-collapse" id="menuResponsivo">
        <ul class="navbar-nav d-flex align-items-center justify-content-between">
    
                <li class="nav-item">
                    <a class="nav-link todos" href="index.php" title="Ver todo o cardápio" onclick="verificarCategoria();">
                        Todos
                    </a>
                </li>

                <?php foreach ($categorias_listar as $c) { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?id=<?= $c['id'] ?>" onclick="verificarCategoria(<?php echo $c['id']; ?>);">
                            <?= $c['nome'] ?>
                        </a>
                    </li>
                <?php } ?>

            </ul>
        </div>
</nav>
<script>

    const url = new URL(window.location.href);
    const id = url.searchParams.get('id');

    function verificarCategoria(id) {

    const categorias = document.querySelectorAll('.nav-link');
    const btnTodos = document.querySelector('.todos');

    categorias.forEach(cat => cat.classList.remove('active'));

    if (!id) {
        if (btnTodos) btnTodos.classList.add('active');
    } else {
        categorias.forEach(cat => {
            const href = cat.getAttribute('href');
            if (href && href.includes(`?id=${id}`)) {
                cat.classList.add('active');
            }
        });
    }
}

verificarCategoria(id);

</script>