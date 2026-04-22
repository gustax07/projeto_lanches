<?php
require_once __DIR__ . '/../../vendor/autoload.php';
use App\Pedidos;
use App\Pedido_Itens;
$pedidoItens = new Pedido_Itens();
$pedidos = new Pedidos();

$pedidos->id = $_GET['id'];
$pedidoItens->id_pedidos_fk = $_GET['id'];

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