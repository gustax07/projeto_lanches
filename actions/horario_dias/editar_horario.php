<?php

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['status' => 'erro', 'message' => 'Método de requisição inválido.']);
    exit;
}
require_once('../../classes/horarios_dias.class.php');
$horario_dia = new HorarioDias();

$dados = json_decode(file_get_contents('php://input'), true);
$id = $dados['id'];
$horario_inicio = $dados['horario_inicio'];
$horario_fim = $dados['horario_fim'];


if (empty($id) || empty($horario_inicio) || empty($horario_fim)) {
    echo json_encode(['status' => 'erro', 'message' => 'Dados incompletos.']);
    exit;
}
if ($horario_dia <= $horario_fim) {
    echo json_encode(['status' => 'erro', 'message' => 'O horário de fim deve ser maior que o horário de início.']);
    exit;
}
if ($horario_inicio === 'null' || $horario_fim === 'null') {
    $horario_inicio = null;
    $horario_fim = null;
}

$horario_dia->id = $id;
$horario_dia->horario_inicio = $horario_inicio;
$horario_dia->horario_fim = $horario_fim;

if ($horario_dia->Editar() > 0) {
    echo json_encode(['status' => 'sucesso', 'message' => 'Horário atualizado com sucesso.']);
    exit;
} else {
    echo json_encode(['status' => 'erro', 'message' => 'Erro ao atualizar o horário.']);
    exit;
}
