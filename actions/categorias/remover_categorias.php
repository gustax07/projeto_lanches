<?php

include_once '../../classes/categorias.class.php';
$categorias = new Categorias();
$categorias->id = $_GET['id'];

if (!empty($_GET['id'])) {
    if ($categorias->Excluir()) {
        header("Location: ../../admin/gerenciar_categorias.php?msg=categoria_excluida");
        die();
    } else {
        header("Location: ../../admin/gerenciar_categorias.php?err=categoria_excluir_falha");
        die();
    }
}

?>