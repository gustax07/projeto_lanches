<?php

include_once("../../classes/pedidos_itens.class.php");
$pedidoItens = new Pedido_Itens();
$pedidoItens->id_pedidos_fk = $_GET['id'];

include_once("../../classes/pedidos.class.php");
$pedidos = new Pedidos();
$pedidos->id = $_GET['id'];

if ($pedidoItens->Excluir()){
    if ($pedidos->Excluir()){
    header("Location: ../../admin/pedidos.php?msg=pedido_removido");
    exit();
    }
    else{
        header("Location: ../../admin/pedidos.php?err=pedido_remover_falha");
        exit();
    }
} else {
    header("Location: ../../admin/pedidos.php?err=pedido_remover_falha");
    exit();
}

?>