<?php


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!empty($_POST['pesquisar'])) {
        header('Location: ../../admin/gerenciar_produtos.php?pesquisar=' . $_POST['pesquisar']);
        exit();
    } else {
        header('Location: ../../admin/gerenciar_produtos.php');
        exit();
    }
}

header('Location: ../../admin/gerenciar_produtos.php');
exit();