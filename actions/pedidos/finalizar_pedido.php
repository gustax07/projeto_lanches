<?php
require_once __DIR__ . '/../../vendor/autoload.php';
use App\Pedidos;
$pedido = new Pedidos();

session_start();

$idUsuario   = $_SESSION['usuario']['id'];
$idPedido    = $_POST['id_pedido'];
$idEndereco  = $_POST['id_endereco'];
$observacoes = strip_tags($_POST['observacoes']) ?? null;

if (!is_numeric($idPedido) || !is_numeric($idEndereco)) {
    header('Location:../../index.php?err=carrinho_vazio');
    exit();
}

$pedido->id = $idPedido;
$pedido->id_usuarios_fk = $idUsuario;
$pedido->id_enderecos_fk = $idEndereco;
$pedido->observacoes = $observacoes;

$pedido->FinalizarPedido();
header('Location:pagar.php?pedido_id=' . $idPedido);
exit();