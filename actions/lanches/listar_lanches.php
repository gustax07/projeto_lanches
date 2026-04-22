<?php
require_once __DIR__ . '/../../vendor/autoload.php';
use App\Itens;
$itens = new Itens();

header('Content-Type: application/json');


$dados = json_decode(file_get_contents('php://input'), true);
$pagina = isset($dados['pagina']) ? (int)$dados['pagina'] : 1;
$offset = ($pagina -1) * 24;

$itens_listar = $itens->Listar(24, $offset);

if ($itens_listar){
    echo json_encode(['status' => 'sucesso', 'lista' => $itens_listar]);
}else {
    echo json_encode(['status' => 'erro', 'message' => 'Nenhum item Encontrado']);
}
exit();
?>