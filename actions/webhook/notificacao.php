<?php

require_once __DIR__ . '/../../vendor/autoload.php';
require_once('../../classes/pedidos.class.php');

use Dotenv\Dotenv;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Client\Payment\PaymentClient;

$pedidos = new Pedidos();

if (file_exists(__DIR__ . '/../../.env')) {
    $dotenv = Dotenv::createImmutable(__DIR__ . '/../../');
    $dotenv->load();
}

MercadoPagoConfig::setAccessToken(
    $_ENV['MP_ACCESS_TOKEN'] ?? getenv('MP_ACCESS_TOKEN')
);

$body = file_get_contents('php://input');
$data = json_decode($body, true);

http_response_code(200);

$paymentId = $data['data']['id'] ?? $_GET['data_id'] ?? $_GET['id'] ?? null;

if (!$paymentId) {
    exit;
}

$client = new PaymentClient();

try {
    $payment = $client->get($paymentId);
} catch (Throwable $e) {
    error_log($e->getMessage());
    exit;
}

if ($payment->status === 'approved') {

    file_put_contents(
    __DIR__.'/debug.txt',
    "STATUS: ".$payment->status." | REF: ".$payment->external_reference.PHP_EOL,
    FILE_APPEND
);

    $pedidoId = $payment->external_reference;

    if (!$pedidoId) {
        exit;
    }

    $pedidos->id = $pedidoId;
    $pedidos->PrepararPedido();
}