<?php
ob_start();
require_once __DIR__ . '/../../vendor/autoload.php';

session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['usuario']['id'])) {
    ob_clean();
    echo json_encode(['status' => 'erro', 'message' => 'Sessão expirada']);
    exit();
}

$idUsuario = (int) $_SESSION['usuario']['id'];
$dados = json_decode(file_get_contents('php://input'), true);
$idItem = (int) ($dados['id'] ?? 0);

if ($idItem <= 0) {
    ob_clean();
    echo json_encode(['status' => 'erro', 'message' => 'Item inválido']);
    exit();
}

try {
    $pedidoItem = new \App\Pedidos_Itens();
    $sucesso = $pedidoItem->RemoverItemSeguro($idUsuario, $idItem);

    ob_clean();
    if ($sucesso) {
        echo json_encode(['status' => 'sucesso', 'message' => 'Item removido']);
    } else {
        echo json_encode(['status' => 'erro', 'message' => 'Item não encontrado ou você não tem permissão']);
    }
    
} catch (Exception $e) {
    ob_clean();
    echo json_encode(['status' => 'erro', 'message' => $e->getMessage()]);
}
exit();