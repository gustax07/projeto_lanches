<?php
require_once __DIR__ . '/../../vendor/autoload.php';
use App\Telefones;
$telefones = new Telefones();

header('Content-Type: application/json; charset=utf-8');

$raw = file_get_contents('php://input');
$data = json_decode($raw, true);

if (!is_array($data) || !isset($data['id'])) {
    echo json_encode([
        'status' => 'erro',
        'msg' => 'Requisição inválida.'
    ]);
    exit;
}

$id = (int)$data['id'];
if ($id <= 0) {
    echo json_encode([
        'status' => 'erro',
        'msg' => 'ID inválido.'
    ]);
    exit;
}

$telefones->id = $id;
$deleted = $telefones->Excluir();

if ($deleted) {
    echo json_encode([
        'status' => 'sucesso',
        'msg' => 'Telefone excluído.'
    ]);
} else {
    echo json_encode([
        'status' => 'erro',
        'msg' => 'Não foi possível excluir o telefone ou não existe.'
    ]);
}

exit;
