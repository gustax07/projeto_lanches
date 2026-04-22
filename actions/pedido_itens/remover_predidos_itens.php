<?php
    require_once __DIR__ . '/../../vendor/autoload.php';
    use App\Pedido_Itens;
    $pedidoItem = new Pedido_Itens();
    
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


if (!isset($_SESSION['usuario'])) {
    header('Location: ../../index.php');
    exit;
}

if (isset($_POST['id_item']) && isset($_POST['id_pedido'])) {
    
    $pedidoItem->id_pedidos_fk = $_POST['id_pedido'];
    $pedidoItem->id_itens_fk   = $_POST['id_item'];

    $linhasAfetadas = $pedidoItem->Excluir();

    if ($linhasAfetadas > 0) {
        header("Location: ".$_SERVER['HTTP_REFERER']);
        exit;
    } else {
        echo "Nenhum item removido no banco. Verifique se o item pertence a este pedido.";
        exit;
    }
} else {
    echo "Dados insuficientes para excluir (Faltou ID do item ou do pedido).";
    exit;
}