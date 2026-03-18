<?php

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../../index.php?err=acesso_nao_autorizado');
    exit;
}

require_once '../../classes/categorias.class.php';
$categorias = new Categorias();
$categorias->nome = $_POST['nome'];

if (!empty($_POST['nome'])) {
    header("Location: ../../admin/gerenciar_categorias.php?pesquisar=" . $_POST['nome']);
}else {
    header("Location: ../../admin/gerenciar_categorias.php?err=campos_vazios");
}

?>