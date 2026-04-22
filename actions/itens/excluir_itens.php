<?php
require_once __DIR__ . '/../../vendor/autoload.php';
use App\Itens;
$itens = new Itens();

if (!isset($_SESSION)) {
    session_start();
}

// Verificar se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
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