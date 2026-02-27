<?php
session_start();
require_once '../../classes/pedidos.class.php';

$idUsuario   = $_SESSION['usuario']['id'];
$idPedido    = $_POST['id_pedido'];
$idEndereco  = $_POST['id_endereco'];
$observacoes = $_POST['observacoes'] ?? null;

if (!is_numeric($idPedido) || !is_numeric($idEndereco)) {
    die('Dados inválidos');
}

$pedido = new Pedidos();
$pedido->id = $idPedido;
$pedido->id_usuarios_fk = $idUsuario;
$pedido->id_enderecos_fk = $idEndereco;
$pedido->observacoes = $observacoes;

$pedido->FinalizarPedido();
//temporariamente manda pro index, dps será mudado pra uma tela de pagamentos
header('Location:../../index.php');
exit();