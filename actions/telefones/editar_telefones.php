<?php
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

require_once('../../classes/telefones.class.php');
$telefones = new Telefones();
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