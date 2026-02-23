<?php

include_once '../../classes/categorias.class.php';
$categorias = new Categorias();
$categorias->nome = $_POST['nome'];
$categorias->id = $_POST['id'];

if (!empty($_POST['nome']) && !empty($_POST['id'])) {
    if ($categorias->Editar()) {
        header("Location: ../../admin/gerenciar_categorias.php?msg=categoria_editada");
        die();
    } else {
        header("Location: ../../admin/gerenciar_categorias.php?err=categoria_editar_falha");
        die();
    }
}
?>