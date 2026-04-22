<?php
require_once __DIR__ . '/../../vendor/autoload.php';
use App\Pedidos;
use App\Pedido_Itens;
$pedidoServico = new Pedidos();
$pedidoItensService = new Pedido_Itens();


use Dotenv\Dotenv;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Exceptions\MPApiException;
use MercadoPago\Client\Preference\PreferenceClient;

if (file_exists(__DIR__ . '/../../.env')) {
    $dotenv = Dotenv::createImmutable(__DIR__ . '/../../');
    if ($dotenv) {
        $dotenv->load();
    }
}

try {
    MercadoPagoConfig::setAccessToken($_ENV['MP_ACCESS_TOKEN'] ?? getenv('MP_ACCESS_TOKEN'));

    if (!isset($_GET['pedido_id'])) {
        throw new Exception("Pedido não informado.");
    }

    $pedidoId = (int) $_GET['pedido_id'];


    $pedidoServico->id = $pedidoId;
    $pedido = $pedidoServico->BuscarPedidosPeloID();

    if (!$pedido) {
        throw new Exception("Pedido não encontrado.");
    }

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
        "notification_url" => "https://tasty.squareweb.app/actions/webhook/notificacao.php",

        "back_urls" => [
            "success" => "https://tasty.squareweb.app/sucesso.php",
            "failure" => "https://tasty.squareweb.app/falha.php",
            "pending" => "https://tasty.squareweb.app/pendente.php"
        ],
        "auto_return" => "approved"
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