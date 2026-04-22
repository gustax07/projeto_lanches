<?php
require_once __DIR__ . '/../../vendor/autoload.php';
use App\Promocoes;
$promocoes = new Promocoes();

require_once('../restrict.php');
$restrict = new restrict();
$restrict->verificarMethodRequest('../../admin/gerenciar_promocoes.php');

$dados = json_decode(file_get_contents('php://input'), true);
$pesquisa = $dados['pesquisa'];

if (empty($pesquisa)) {
    echo json_encode(['pesquisa' => $pesquisa]);
    exit();
}

$promocoes_listar = $promocoes->PesquisarPromocao($pesquisa);

if ($promocoes_listar) {
    echo json_encode(['status' => 'sucesso', 'message' => $pesquisa, 'promocoes' => $promocoes_listar]);
    exit();
} else {
    echo json_encode(['status' => 'erro', 'message' => 'Nenhuma promoção encontrada.']);
    exit();
}



?>