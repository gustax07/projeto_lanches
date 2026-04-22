<?php
require_once __DIR__ . '/../../vendor/autoload.php';
use App\Categorias;
$categorias = new Categorias();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../../index.php?err=acesso_nao_autorizado');
    exit;
}

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
}else {
    header("Location: ../../admin/gerenciar_categorias.php?err=campos_vazios");
    die();
}
?>