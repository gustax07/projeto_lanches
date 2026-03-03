<?php
require_once __DIR__ . '/../../vendor/autoload.php';
require_once ('../../classes/pedidos.class.php');     
require_once ('../../classes/pedidos_itens.class.php');

use MercadoPago\MercadoPagoConfig;
use MercadoPago\Exceptions\MPApiException;
use MercadoPago\Client\Preference\PreferenceClient;

try {
    MercadoPagoConfig::setAccessToken('acess_token_aqui'); // Coloque aqui o token de acesso do mercado pago

    if (!isset($_GET['pedido_id'])) {
        throw new Exception("Pedido não informado.");
    }

    $pedidoId = (int) $_GET['pedido_id'];


    $pedidoServico = new Pedidos();
    $pedidoServico->id = $pedidoId;
    $pedido = $pedidoServico->BuscarPedidosPeloID();

    if (!$pedido) {
        throw new Exception("Pedido não encontrado.");
    }

    $pedidoItensService = new Pedido_Itens();
    $valorTotal = $pedidoItensService->calcularTotalPedido($pedidoId);


// Criar preferência de pagamento (Checkout Pro)
    $client = new PreferenceClient();

    $preference = $client->create([
        "items" => [
            [
                "title" => "Tasty Burguer, pedido #{$pedidoId}",
                "quantity" => 1,
                "unit_price" => $valorTotal
            ]
        ],
        "external_reference" => $pedidoId,
        "back_urls" => [
            "success" => "http://localhost/projects/projeto_lanches/actions/pedidos/sucesso.php",
            "failure" => "http://localhost/projects/projeto_lanches/actions/pedidos/falha.php",
            "pending" => "http://localhost/projects/projeto_lanches/actions/pedidos/pendente.php"
        ],
        // "auto_return" => "approved"
    ]);

    


    // Redirecionar para o Mercado Pago

    header("Location: " . $preference->init_point);
    exit;

} catch (MPApiException $e) {
    echo "<pre>";
    echo "STATUS CODE:\n";
    var_dump($e->getApiResponse()->getStatusCode());
    echo "\nRESPOSTA DA API:\n";
    var_dump($e->getApiResponse()->getContent());
    echo "</pre>";
    exit;
}