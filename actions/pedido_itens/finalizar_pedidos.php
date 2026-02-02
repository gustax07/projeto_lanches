<?php

require_once("../../dompdf/autoload.inc.php");
use Dompdf\Dompdf;
require_once("../../classes/pedidos_itens.class.php");
$pedidoItens = new Pedido_Itens();

$pedidoItens->id_pedidos_fk = $_GET['id'] ?? 0;
$itens_pedido = $pedidoItens->ListarPedidoInnerJoinComID();
$html = '<h1>Detalhes do Pedido</h1>';
foreach ($itens_pedido as $item) {
    $html .= "<p><strong>Item:</strong> " . $item['Pedido'] . "</p>";
    $html .= "<p><strong>Descrição:</strong> " . $item['descricao'] . "</p>";
    $html .= "<p><strong>Quantidade:</strong> " . $item['quantidade'] . "</p>";
    $html .= "<p><strong>Preço:</strong> R$ " . $item['preco'] . "</p>";
    $html .= "<p><strong>Data do Pedido:</strong> " . $item['data_pedido'] . "</p>";
    $html .= "<p><strong>Observações:</strong> " . $item['observacoes'] . "</p>";
    $html .= "<hr>";
}
$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->render();
$dompdf->stream("pedido.pdf", array("Attachment" => false));

?>