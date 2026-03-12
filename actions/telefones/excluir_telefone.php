<?php
// Endpoint para excluir telefone via JSON POST
header('Content-Type: application/json; charset=utf-8');

$raw = file_get_contents('php://input');
$data = json_decode($raw, true);

require_once('../../classes/telefones.class.php');
$telefones = new Telefones();

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
