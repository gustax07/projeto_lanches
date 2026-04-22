<?php
require_once __DIR__ . '/../../vendor/autoload.php';
use App\Itens;
$itens = new Itens();

header('Content-Type: application/json');


$dados = json_decode(file_get_contents('php://input'), true);
$id_categoria = $dados['id_categoria'];
$itens->id_categoria_fk = $id_categoria;
$itensCategoria = $itens->ListarPorCategoria();

if ($itensCategoria) {
    echo json_encode(['status' => 'sucesso', 'lista' => $itensCategoria]);
} else {
    echo json_encode(['status' => 'erro', 'message' => 'Não foi possível encontrar itens']);
}
exit;

?>