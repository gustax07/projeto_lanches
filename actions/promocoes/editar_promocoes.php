<?php

require_once('../restrict.php');
$restrict = new restrict();
$restrict->verificarMethodRequest('../../admin/gerenciar_promocoes.php');

$data = json_decode(file_get_contents('php://input'), true);

$id = $data['id'];
$nome = $data['nome'];
$preco = $data['preco'];
$validade = $data['validade'];
$preco_original = $data['preco_original'];


if (empty($id) || empty($nome) || empty($preco) || empty($validade)){
    echo json_encode(['status' => 'erro', 'message' => 'Dados incompletos.']);
    exit();
}

if ($preco < 0.10 || $preco >= $preco_original){
    echo json_encode(['status' => 'erro', 'message' => 'O preço deve ser maior que 0.10 e menor que o preço original.']);
    exit();
}

if(!is_numeric($preco) || !is_numeric($preco_original)){
    echo json_encode(['status' => 'erro', 'message' => 'O preço deve ser um número.']);
    exit();
}

$dataAtual = date('Y-m-d');
if ($validade < $dataAtual){
  echo json_encode(['status' => 'erro', 'message' => 'A data de validade deve ser maior que a data atual.']);
    exit();
}

require_once('../../classes/promocoes.php');
$promocoes = new Promocoes();
$promocoes->id = $id;
$promocoes->nome_promocao = $nome;
$promocoes->preco_promocional = $preco;
$promocoes->data_validade = $validade;

if ($promocoes->Editar()){
    echo json_encode(['status' => 'sucesso', 'message' => 'Promoção atualizada com sucesso.']);
    exit();
}else{
    echo json_encode(['status' => 'erro', 'message' => 'Erro ao atualizar a promoção.']);
    exit();
}

?>