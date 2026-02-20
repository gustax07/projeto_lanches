<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once '../../classes/pedidos.class.php';
require_once '../../classes/pedidos_itens.class.php';

if (!isset($_SESSION['usuario'])) {
    header('Location: ../../login.php');
    exit;
}

if (!isset($_POST['id_item'])) {
    echo 'ID do item não recebido';
    exit;
}

$idUsuario = $_SESSION['usuario']['id'];
$idItem    = $_POST['id_item'];

// 1️⃣ Buscar pedido pendente
$pedido = new Pedidos();
$pedido->id_usuarios_fk = $idUsuario;

$pedidoAberto = $pedido->BuscarPedidosAbertos();

if (empty($pedidoAberto)) {
    // 2️⃣ Criar novo pedido
    $pedido->status = 'pendente';
    $pedido->data_pedido = date('Y-m-d H:i:s');
    $pedido->Cadastrar();

    // ✅ AGORA SIM: pegar o último ID
    $idPedido = $pedido->UltimoID();
} else {
    $idPedido = $pedidoAberto[0]['id'];
}

// 3️⃣ Salvar pedido aberto na sessão (opcional, mas útil)
$_SESSION['pedido_aberto'] = $idPedido;

// 4️⃣ Adicionar item ao pedido
$itemPedido = new Pedido_Itens();
$itemPedido->id_pedidos_fk = $idPedido;
$itemPedido->id_itens_fk   = $idItem;
$itemPedido->quantidade    = 1;

$itemPedido->Cadastrar();

header('Location: ../../index.php');
exit;