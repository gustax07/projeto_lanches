<?php

use FontLib\Table\Type\head;

include_once('../../classes/pedidos.class.php');
$pedidos = new Pedidos();
$pedidos->id = $_GET['id'];
$pedidos->status = $pedidos->ListarStatusComID()[0]['status'];

//war: aviso que o status ja esta setado!
//msg: sucesso ao setar o status!
//err: falha ao setar o status

//mudar status para 'preparando'
if ($pedidos->status == 'pendente') { // se estiver pendente, entao ele sera preparado
    if ($pedidos->PrepararPedido()) {
        header("Location: ../../admin/pedidos.php?msg=pedido_status_alterado");
        exit();
    } else {
        header("Location: ../../admin/pedidos.php?err=pedido_concluir_falha");
        exit();
    }
} else if ($pedidos->status == 'preparando') { // se estiver sendo preparado, entao ele sera concluido
    if ($pedidos->ConcluirPedido()) {
        header("Location: ../../admin/pedidos.php?msg=pedido_status_alterado");
        exit();
    } else {
        header("Location: ../../admin/pedidos.php?err=pedido_concluir_falha");
        exit();
    }
} else if ($pedidos->status == 'concluido') { //se o pedido ja foi concluido, ele sera marcodo como saiu para entrega
    if ($pedidos->SaiuParaEntregaPedido()) {
        header("Location: ../../admin/pedidos.php?msg=pedido_status_alterado");
        exit();
    } else {
        header("Location: ../../admin/pedidos.php?err=pedido_concluir_falha");
        exit();
    }   
} else {
    //cancelar pedido
    if ($pedidos->CancelarPedido()) {
        header("Location: ../../admin/pedidos.php?msg=pedido_cancelado");
        exit();
    } else {
        header("Location: ../../admin/pedidos.php?err=pedido_cancelar_falha");
        exit();
    }
}



?>