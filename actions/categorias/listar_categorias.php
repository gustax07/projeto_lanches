<?php
ob_start();
header('Content-Type: application/json');
require_once __DIR__ . '/../../vendor/autoload.php';
use App\Categorias;

try {
    $categorias = new Categorias();
    $lista_categorias = $categorias->Listar();

    if ($lista_categorias >= 0) {
        echo json_encode(['status' => 'sucesso', 'lista' => $lista_categorias]);
    } else {
        echo json_encode(['status' => 'erro', 'message' => 'Nenhuma categoria encontrada']);
    }
} catch (Exception $e) {
    echo json_encode(['status' => 'erro', 'message' => $e->getMessage()]);
}

ob_end_flush();
exit();