<?php
ob_start();
session_start();
header('Content-Type: application/json');

require_once __DIR__ . '/../../vendor/autoload.php';

use App\Pedidos;
use App\Pedidos_Itens;

//verificar sessao
if (!isset($_SESSION['usuario'])) {
    echo json_encode(['status' => 'erro', 'message' => 'Sessão expirada']);
    exit();
}

$idUsuario = (int) $_SESSION['usuario']['id'] ?? null;

if (!$idUsuario) {
    echo json_encode(['status' => 'erro', 'message' => 'Usuário não encontrado']);
    exit();
}

try {
    $pedidos_itens = new Pedidos_Itens();
    $pedidos = new Pedidos();

    $pedidos->id_usuarios_fk = (int) $idUsuario;
    $lista_pedidos = $pedidos->BuscarPedidosAbertos();

    if (!empty($lista_pedidos) && isset($lista_pedidos[0]['id'])) {

        $pedidos_itens->id_pedidos_fk = (int) $lista_pedidos[0]['id'];
        $listar_itens_pedidos = (array) $pedidos_itens->ListarPorPedido();

        if ($listar_itens_pedidos) {
            echo json_encode(['status' => 'sucesso', 'lista' => $listar_itens_pedidos]);
        } else {
            echo json_encode(['status' => 'erro', 'message' => 'Pedido está vazio']);
        }
    } else {
        echo json_encode(['status' => 'erro', 'message' => 'Nenhum pedido encontrado']);
    }
} catch (Exception $e) {
    echo json_encode(['status' => 'erro', 'message' => $e->getMessage()]);
}

ob_end_flush();
exit();
