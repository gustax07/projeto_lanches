<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once('../../classes/pedidos_itens.class.php');

if (!isset($_SESSION['usuario'])) {
    header('Location: ../../index.php');
    exit;
}

$pedidoItem = new Pedido_Itens();
$pedidoItem->id_pedidos_fk = $_SESSION['pedido_aberto'];
$pedidoItem->id_itens_fk   = $_POST['id_item'];

$pedidoItem->Excluir();
header("Location: ".$_SERVER['HTTP_REFERER']);
exit;