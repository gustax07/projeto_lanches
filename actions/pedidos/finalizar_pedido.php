<?php
session_start();
require_once '../../classes/pedidos.class.php';

$idUsuario   = $_SESSION['usuario']['id'];
$idPedido    = $_POST['id_pedido'];
$idEndereco  = $_POST['id_endereco'];
$observacoes = strip_tags($_POST['observacoes']) ?? null;

if (!is_numeric($idPedido) || !is_numeric($idEndereco)) {
    header('Location:../../index.php?err=carrinho_vazio');
    exit();
}

$pedido = new Pedidos();
$pedido->id = $idPedido;
$pedido->id_usuarios_fk = $idUsuario;
$pedido->id_enderecos_fk = $idEndereco;
$pedido->observacoes = $observacoes;

$pedido->FinalizarPedido();
header('Location:pagar.php?pedido_id=' . $idPedido);
exit();