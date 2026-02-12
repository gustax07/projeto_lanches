<?php

include_once('../../classes/pedidos.class.php');
$pedidos = new Pedidos();
$pedidos->status = $_POST['status'];


if (!empty($_POST['status'] && $_POST['status'] != 'Todos')) {
    header("Location: ../../admin/pedidos.php?status=" . $_POST['status']);
} elseif ($_POST['status'] == 'Todos') {
    header("Location: ../../admin/pedidos.php");
}
?>