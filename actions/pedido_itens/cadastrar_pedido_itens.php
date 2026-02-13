<?php
session_start();

require_once('../../classes/pedidos.class.php');
require_once('../../classes/pedidos_itens.class.php');

if (!isset($_SESSION['usuario'])) {
    header('Location: ../../login.php');
    exit;
}

if (!isset($_POST['id_item'])) {
    echo 'ID do item não recebido';
    exit;
}

$idUsuario = $_SESSION['usuario']['id'];
$idItem = $_POST['id_item'];

// buscar pedido aberto
$pedido = new Pedidos();
$pedido->id_usuarios_fk = $idUsuario;

$pedidoAberto = $pedido->BuscarPedidosAbertos(); // deve retornar UM pedido ou null


// se não existir, cria pedido
if (!$pedidoAberto) {
    $pedido->status = 'aberto';
    $pedido->Cadastrar();

    // pega o pedido recém-criado
    $pedidoAberto = $pedido->BuscarPedidosAbertos();
}

// agora temos o ID do pedido
$pedidoAberto[0]['id'];
$idPedido = $pedidoAberto[0]['id'];


// cadastra item no pedido
$itemPedido = new Pedido_Itens();
$itemPedido->id_pedidos_fk = $idPedido;
$itemPedido->id_itens_fk = $idItem;
$itemPedido->quantidade = 1;

$itemPedido->Cadastrar();

// volta pra página
header('Location: ../../index.php');
exit;
