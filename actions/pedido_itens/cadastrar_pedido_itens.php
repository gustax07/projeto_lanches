<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once '../../classes/pedidos.class.php';
require_once '../../classes/pedidos_itens.class.php';

if (!isset($_SESSION['usuario'])) {
    header('Location: ../../logar.php');
    exit;
}

if (!isset($_POST['id_item'])) {
    echo 'ID do item não recebido';
    exit;
}

$idUsuario = $_SESSION['usuario']['id'];
$idItem    = $_POST['id_item'];

$quantidade = $_POST['quantidade'] ?? 1;
$quantidade = (int) $quantidade;
if ($quantidade < 1) {
    $quantidade = 1;
} elseif ($quantidade > 99) {
    $quantidade = 99;
}

$pedido = new Pedidos();
$pedido->id_usuarios_fk = $idUsuario;

$pedidoAberto = $pedido->BuscarPedidosAbertos();

if (empty($pedidoAberto)) {
    
    $pedido->status = 'pendente';
    $pedido->data_pedido = date('Y-m-d H:i:s');
    $pedido->Cadastrar();

    $idPedido = $pedido->UltimoID();
} else {
    $idPedido = $pedidoAberto[0]['id'];
}

$_SESSION['pedido_aberto'] = $idPedido;

$itemPedido = new Pedido_Itens();
$itemPedido->id_pedidos_fk = $idPedido;
$itemPedido->id_itens_fk   = $idItem;
$itemPedido->quantidade    = $quantidade;

$itemPedido->Cadastrar();

header('Location: ../../index.php');
exit;