<?php
require_once __DIR__ . '/../../vendor/autoload.php';
use App\Telefones;
$telefones = new Telefones();

session_start();

if (!isset($_SESSION['usuario']['id'])) {
    header('Location: ../../logar.php');
    exit;
}
$dados = json_decode(file_get_contents('php://input'), true);

$telefones->id_usuarios_fk = $_SESSION['usuario']['id'];
$telefones->numero = $dados['telefone'];
$telefones->ddi = $dados['ddi'];

if ($telefones->Cadastrar()) {
    echo json_encode([
        "status" => "sucesso"
    ]);
} else {
    echo json_encode([
        "status" => "erro"
    ]);
}
