<?php
include_once('../../classes/pedidos.class.php');
$pedidos = new Pedidos();
$pedidos->id = $_GET['id'];
$pedidos_info = $pedidos->ListarStatusComID();
$pedidos->status = $pedidos_info[0]['status'];

if ($pedidos->status == 'cancelado') {
    header("Location: ../../admin/pedidos.php?warn=pedido_cancelado");
exit();
} else {
    if ($pedidos->CancelarPedido()) {
        header("Location: ../../admin/pedidos.php?msg=pedido_cancelado");
        exit();
    } else {
        header("Location: ../../admin/pedidos.php?err=pedido_cancelar_falha");
        exit();
    }
}
