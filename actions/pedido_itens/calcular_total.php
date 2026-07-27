<?php
ob_start();
require_once __DIR__ . '/../../vendor/autoload.php';

session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['usuario']['id'])) {
    ob_clean(); // Limpa o buffer
    echo json_encode(['status' => 'erro', 'message' => 'Sessão expirada']);
    exit();
}

try {
    $pedidos_itens = new \App\Pedidos_Itens();
    $pedidos = new \App\Pedidos();
    $pedidos->id_usuarios_fk = $_SESSION['usuario']['id'];
    $idPedidoAberto = $pedidos->BuscarPedidosAbertos();
    $total =   $pedidos_itens->calcularTotalPedido($idPedidoAberto[0]['id']);
    ob_clean();
    echo json_encode(['status' => 'sucesso', 'message' => $total]);
} catch (Exception $e) {
    ob_clean();
    echo json_encode(['status' => 'erro', 'message' => $e->getMessage()]);
}

ob_end_flush();
exit();
