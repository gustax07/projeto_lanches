<?php
require_once("../../classes/pedidos_itens.class.php");
$pedidoItens = new Pedido_Itens();
$pedidoItens->id_pedidos_fk = $_GET['id'] ?? 0;
$itens_pedido = $pedidoItens->ListarPedidoInnerJoinComID();

if (!count($itens_pedido)) {
    echo "<p>Nenhum item encontrado para este pedido.</p>";
    exit;
} else {
    foreach ($itens_pedido as $item) {
        echo "<h2>Nº do Pedido: " . $item['id'] . "<br></h2>";
        echo "<hr>";
        echo "<i class='bi bi-cart-plus-fill'></i> </i><strong>Pedido:</strong><br>"; 
        for ($i = 0; $i < $item['quantidade']; $i++) {
            echo "1X: " . $item['Pedido'] . " (" . $item['descricao'] . ") - R$" . $item['preco'] . "<br>";
        }
        echo "<br>";
        echo "<i class='bi bi-pass-fill'></i> <strong>Observações:</strong><br>" . $item['observacoes'];
        echo "<hr>";
        echo "<i class='bi bi-calendar-event-fill'></i> <strong>Data do Pedido:</strong><p>" . $item['data_pedido'] . "</p>";

        echo "<hr>";
        echo "<h4>Total: R$ " . $item['preco'] * $item['quantidade'] . "</h4>";
        
        exit;
    }
}
include_once("../../classes/bootstrap_include.php");
?>