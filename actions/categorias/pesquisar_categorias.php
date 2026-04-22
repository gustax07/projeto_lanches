<?php
require_once __DIR__ . '/../../vendor/autoload.php';
use App\Categorias;
$categorias = new Categorias();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../../index.php?err=acesso_nao_autorizado');
    exit;
}

$categorias->nome = $_POST['nome'];

if (!empty($_POST['nome'])) {
    header("Location: ../../admin/gerenciar_categorias.php?pesquisar=" . $_POST['nome']);
}else {
    header("Location: ../../admin/gerenciar_categorias.php?err=campos_vazios");
}

?>