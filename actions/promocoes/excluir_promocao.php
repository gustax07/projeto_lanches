<?php
require_once __DIR__ . '/../../vendor/autoload.php';
use App\Promocoes;
$promocoes = new Promocoes();

require('../restrict.php');
$restrict = new restrict();
$restrict->verificarMethodRequest('../../admin/gerenciar_promocoes.php');

$dados = json_decode(file_get_contents('php://input'), true);
$id = $dados['id'];

if (empty($id)){
    echo json_encode(['status' => 'erro', 'message' => 'Id não encontrado.']);
    exit();
}

if (!is_numeric($id)){
    echo json_encode(['status' => 'erro', 'message' => 'Id deve ser um número.']);
    exit();
}

$promocoes->id = $id;

if ($promocoes->Excluir()){
    echo json_encode(['status' => 'sucesso', 'message' => 'Produto excluído com sucesso.']);
    exit();
}else{
    echo json_encode(['status' => 'erro', 'message' => 'Não foi possível excluir o produto.']);
    exit();
}

?>