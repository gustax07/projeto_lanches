<?php

include_once("../../classes/pedidos.class.php");
$Pedidos = new Pedidos();
$nome = $_POST['pesquisar'];
print_r($nome);

if (!empty($_POST['pesquisar'])) {
    $Pedidos->nome = $_POST['pesquisar'];
    $Pedidos->ListarPedidosPeloNomeCliente();
    header("Location: ../../admin/pedidos.php?pesquisar=$nome");
} else {
    header("Location: ../../admin/pedidos.php");
}

?>