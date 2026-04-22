<?php
require_once __DIR__ . '/../../vendor/autoload.php';  
use App\Categorias;
$categorias = new Categorias();

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    header('Location: ../../index.php?err=acesso_nao_autorizado');
    exit;
}

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
else {
    header("Location: ../../admin/gerenciar_categorias.php?err=campos_vazios");
    die();
}

?>