<?php
ob_start();
session_start();
require_once __DIR__ . '/../../vendor/autoload.php';

use App\Pedidos_Itens;
use App\Pedidos;

header('Content-Type: application/json');
$dados = json_decode(file_get_contents('php://input'), true);

$pedidos_itens = new Pedidos_Itens();
$pedidos = new Pedidos();

//verificar se os dados nao vieram vazios ou modificados de forma indevida
if (empty($dados)){
    echo json_encode(['status' => 'erro', 'message' => 'Informações incompletas.']);
    exit();
}

//salvar em variaveis
$idItem = (int) $dados['id'];
$quantidade = (int) $dados['quantidade'];

//verificar se a quantidade não passou do limite (intercepetações) 
if ($quantidade > 10 || $quantidade < 1){
    echo json_encode(['status' => 'erro', 'message' => 'Limite atingida do produto']);
    exit();
}

//verificar se a sessão está ativa
if (!isset($_SESSION['usuario'])) {
    echo json_encode([
        'status' => 'erro',
        'message' => 'Você precisa estar logado para realizar esta ação.'
    ]);
    exit();
}
//pega o id do usario, no caso o dono do pedido
$idUsuario = (int) $_SESSION['usuario']['id'];

//verificar se o id existe
if (empty($idUsuario)) {
    echo json_encode(['status' => 'erro', 'message' => 'Usuario não encontrado']);
    exit();
}

//fazer a busca do pedido aberto
$pedidos->id_usuarios_fk = $idUsuario;
$idPedido = $pedidos->BuscarPedidosAbertos();

//verificar se o pedido existe na conta do usuario
if (!empty($idPedido) && isset($idPedido[0]['id'])) {

    $pedidos_itens->id_pedidos_fk = $idPedido[0]['id'];
    $pedidos_itens->id_itens_fk = $idItem;
    $pedidos_itens->quantidade = $quantidade;
    $quantidade_atualizada = $pedidos_itens->addQuantidade();

    //verificar se o addQuantidade foi realizado com sucesso
    if ($quantidade_atualizada >= 0) {
        echo json_encode(['status' => 'sucesso', 'message' => 'Quantidade Alterada com Sucesso!', 'quantidade' => $quantidade]);
    } else {
        echo json_encode(['status' => 'erro', 'message' => 'Falha ao Atualizar a quantidade do produto']);
    }
} else {
    echo json_encode(['status' => 'erro', 'message' => 'Pedido invalido ou nao encontrado']);
}
ob_end_flush();
exit();
