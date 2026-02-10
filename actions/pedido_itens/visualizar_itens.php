<?php
require_once("../../classes/pedidos_itens.class.php");
$pedidoItens = new Pedido_Itens();
$pedidoItens->id_pedidos_fk = $_GET['id'];
$itens_pedido = $pedidoItens->ListarPedidoInnerJoinComID();
$id = $_GET['id'];
include_once('../../classes/pedidos.class.php');
$pedidos = new Pedidos();
$pedidos->id = $_GET['id'];
$pedidos_listar_status = $pedidos->ListarStatusComID();
$total = 0;
if (!count($itens_pedido)) {
    echo "<p>Nenhum item encontrado para este pedido.</p>";
    echo "<button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Fechar</button>";
    exit;
} else {
    echo "<h2>Nº do Pedido: " . $id . "</h2><hr>";
    echo "<strong>Pedido:</strong><br>";

    foreach ($itens_pedido as $item) {

        echo $item['quantidade'] . "x "
            . $item['Pedido']
            . " (" . $item['descricao'] . ") - R$ "
            . number_format($item['preco'], 2, ',', '.')
            . "<br>";

        $total += $item['preco'] * $item['quantidade'];
    }

    echo "<hr>";
    echo "<strong>Observações:</strong><br>" . $item['observacoes'] . "<br>";
    echo "<strong>Data do Pedido:</strong> " . $item['data_pedido'] . "<br>";

    echo "<hr>";
    echo "<h4>Total: R$ " . number_format($total, 2, ',', '.') . "</h4>";


    echo "<div class='modal-footer'>";
    if ($pedidos_listar_status[0]['status'] == 'preparando') {
        // mudar estatus para 'concluido'
        echo "<a href='../actions/pedidos/alterar_status_pedidos.php?id=" . $id . "' class='btn btn-success '>Concluir Pedido</a>";
        echo "<a href='../actions/pedidos/cancelar_pedidos.php?id=" . $id . "' class='btn btn-danger'>Cancelar</a>";
    } else if ($pedidos_listar_status[0]['status'] == 'pendente') {
        // mudar estatus para 'preparando'
        echo "<a href='../actions/pedidos/alterar_status_pedidos.php?id=" . $id . "' class='btn btn-primary '>Preprarar</a>";
        echo "<a href='../actions/pedidos/cancelar_pedidos.php?id=" . $id . "' class='btn btn-danger'>Cancelar</a>";
    } else if ($pedidos_listar_status[0]['status'] == 'concluido') {
        // mudar estatus para 'saiu para entrega'
        echo "<a href='../actions/pedidos/alterar_status_pedidos.php?id=" . $id . "' class='btn btn-primary '>Marcar Saida</a>";
        echo "<a href='../actions/pedidos/cancelar_pedidos.php?id=" . $id . "' class='btn btn-danger'>Cancelar</a>";
    }

    echo "<button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Fechar</button>";
    echo "</div>";
    exit;
}
include_once("../../classes/bootstrap_include.php");
