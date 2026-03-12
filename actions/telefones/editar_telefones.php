<?php
$dados = json_decode(file_get_contents("php://input"), true);


$id = $dados['id'];
$telefone = $dados['telefone'];
$ddi = $dados['ddi'];
$idUsuario = $dados['idUsuario'];

$telefone = str_replace("(", "", $telefone);
$telefone = str_replace(")", "", $telefone);
$telefone = str_replace("-", "", $telefone);
$telefone = str_replace(" ", "", $telefone);

$telefone = substr($telefone, 0, 9);

$telefone = preg_replace('/[^0-9]/', '', $telefone);

if ($telefone == "") {
    echo json_encode([
        "status" => "erro",
        "msg" => "Telefone vazio"
    ]);
    exit();
}

require_once('../../classes/telefones.class.php');
$telefones = new Telefones();
$telefones->id = $id;
$telefones->id_usuarios_fk = $idUsuario;
$telefones->numero = $telefone;
$telefones->ddi = $ddi;

if ($telefones->Editar()){
    echo json_encode([
        "status" => "ok"
        
    ]);
}else {
    echo json_encode([
        "status" => "erro",
        "msg" => "Telefone ja cadastrado"
    ]);
}



?>