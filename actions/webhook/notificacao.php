<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once('../../classes/pedidos.class.php');
$pedidos = new Pedidos();

use Dotenv\Dotenv;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Client\Payment\PaymentClient;


$envPath = __DIR__ . '/../../.env';

if (file_exists($envPath)) {
    $dotenv = Dotenv::createImmutable(dirname($envPath));
    $dotenv->load();
}

MercadoPagoConfig::setAccessToken(
    $_ENV['MP_ACCESS_TOKEN'] ?? getenv('MP_ACCESS_TOKEN')
);

$body = file_get_contents('php://input');
$data = json_decode($body, true);

http_response_code(200);

if (!isset($data['data']['id'])) {
    exit;
}

$paymentId = $data['data']['id'];

$client = new PaymentClient();

try {
    $payment = $client->get($paymentId);
} catch (Throwable $e) {
    error_log($e->getMessage());
    exit;
}

if ($payment->status === 'approved' && $pedido->status !== 'preparando') {

    $pedidoId = $payment->external_reference;
    $pedidos->id = $pedidoId;
    $pedidos->PrepararPedido();
}
