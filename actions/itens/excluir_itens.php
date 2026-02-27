<?php

if (!isset($_SESSION)) {
    session_start();
}

require_once('../../classes/itens.class.php');

// Verificar se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $itens = new Itens();
    $id = strip_tags($_GET['id'] ?? '');
    $itens->id = $id;
    $imagem = $itens->ListarPorID()[0]['imagem'];


    if ($itens->Excluir()) {
        header('Location: ../../admin/gerenciar_produtos.php?msg=itens_excluidos');
           unlink('../../images/' . $imagem);
        exit;
    } else {
        header('Location: ../../admin/gerenciar_produtos.php?err=itens_excluidos_falha');
        exit;
    }
}

?>