<?php
require_once __DIR__ . '/../../vendor/autoload.php';
use App\Telefones;
$telefones = new Telefones();

$dados = json_decode(file_get_contents("php://input"), true);

$id = $dados['id'];
$telefone = $dados['telefone'];
$ddi = $dados['ddi'];

if ($telefone == "" || $ddi == "") {
    echo json_encode([
        "status" => "erro",
        "msg" => "Telefone vazio"
    ]);
    exit();
}

$telefones->id = $id;
$telefones->numero = $telefone;
$telefones->ddi = $ddi;

if ($telefones->Editar()){
    echo json_encode([
        "status" => "sucesso"
        
    ]);
}else {
    echo json_encode([
        "status" => "erro",
        "msg" => "Telefone ja cadastrado"
    ]);
}

?>