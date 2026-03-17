<?php

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../../index.php?err=acesso_nao_autorizado');
    exit;
}

include_once '../../classes/categorias.class.php';
$categorias = new Categorias();
$categorias->nome = $_POST['nome'];

if (!empty($_POST['nome'])) {
    if ($categorias->Cadastrar()) {
        header("Location: ../../admin/gerenciar_categorias.php?msg=categoria_cadastrada");
        die();
    } else {
        header("Location: ../../admin/gerenciar_categorias.php?err=categoria_cadastro_falha");
        die();
    }
}else {
    header("Location: ../../admin/gerenciar_categorias.php?err=campos_vazios");
    die();
}
?>