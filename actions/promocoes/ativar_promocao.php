<?php
require_once __DIR__ . '/../../vendor/autoload.php';
use App\Promocoes;
$promocoes = new Promocoes();

require_once('../restrict.php');
$restrict = new restrict();
$restrict->verificarMethodRequest('../../admin/gerenciar_promocoes.php');

$dados = json_decode(file_get_contents('php://input'), true);
$id = $dados['id'];
$status = $dados['status'];

$promocoes->id = $id;
$promocoes->status = $status;

if ($promocoes->AlterarStatus()){
    echo json_encode(['status' => 'sucesso', 'message' => 'Status alterado com sucesso.']);
    exit();
}else{
    echo json_encode(['status' => 'erro', 'message' => 'Erro ao alterar o status '. $id . ',' . $status]);
    exit();
}

?>