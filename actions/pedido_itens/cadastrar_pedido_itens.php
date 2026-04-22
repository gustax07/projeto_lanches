<?php
require_once __DIR__ . '/../../vendor/autoload.php';
use App\Pedidos;
use App\Pedidos_Itens;
$pedidos = new Pedidos();
$pedido_itens = new Pedidos_Itens();

header('Content-Type: application/json');
session_start();
$dados = json_decode(file_get_contents('php://input'), true);

if (empty($dados)) {
    echo json_encode(['status' => 'ERRO', 'message' => 'Dados vazios' ]);
    exit();
}

if (!isset($_SESSION['usuario'])) {
    echo json_encode(['status' => 'ERRO', 'message' => 'Nenhum usuário logado, Faça login ou cadastre-se primeiro!' ]);
    exit();
}

$id_usuario = (int) $_SESSION['usuario']['id'];
$id_item = (int) $dados['id_item'];
$quantidade = (int) $dados['quantidade'];

//verificar se o id_item nao esta vazio
if (empty($id_item) || empty($quantidade)) {
    echo json_encode(['status' => 'ERRO', 'message' => 'Dados incompletos' ]);
    exit();
}


//verificar se tem um pedido criado
$pedidos->id_usuarios_fk = $id_usuario;
$idPedidoAberto = $pedidos->BuscarPedidosAbertos();

if (empty($idPedidoAberto)) {
    //criar um novo pedido raiz
    $pedidos->data_pedido = date('Y-m-d H:i:s');
    $pedidos->id_usuarios_fk = $id_usuario;

    if (!$pedidos->Cadastrar()) {
        echo json_encode(['status' => 'ERRO', 'message' => 'Erro ao criar pedido raiz' ]);
        exit();
    }
    //pegar o id do pedido criado
    $idPedidoAberto = $pedidos->BuscarPedidosAbertos();
    $idPedido = $idPedidoAberto[0]['id'];
} else {
    //pegar o id do pedido já existente
    $idPedido = $idPedidoAberto[0]['id'];
}

$pedido_itens->id_pedidos_fk = $idPedido;
$pedido_itens->id_itens_fk = $id_item;
$pedido_itens->quantidade = $quantidade;

if ($pedido_itens->Cadastrar()) {
    echo json_encode(['status' => 'sucesso', 'message' => 'Lanche adicionado ao carrinho!' ]);
    exit();
} else {
    echo json_encode(['status' => 'ERRO', 'message' => 'Erro ao cadastrar lanche no carrinho' ]);
    exit();
}
?>