<?php

include_once('../../classes/pedidos.class.php');
$pedidos = new Pedidos();
$pedidos->id = $_GET['id'];
$pedidos->status= $pedidos->Listar()[0]['status'];

if ($pedidos->status == 'preparando') {
    header("Location: ../../admin/pedidos.php?warn=pedido_preparar");
    exit();
}
else {
    if ($pedidos->PrepararPedido()) {
        header("Location: ../../admin/pedidos.php?msg=pedido_preparar");
        exit();
    } else {
        header("Location: ../../admin/pedidos.php?err=pedido_preparar_falha");
        exit();
    }
}
?>