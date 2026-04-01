<?php

require_once('../restrict.php');
$restrict = new restrict();
$restrict->verificarMethodRequest('../../admin/gerenciar_promocoes.php');

$dados = json_decode(file_get_contents('php://input'), true);
$nomePromocao = $dados['nome'];
$precoPromocional = $dados['preco'];
$dataValidade = $dados['validade'];
$precoOriginal = $dados['precoOriginal'];
$idItemFk = $dados['idItemFk'];

if (empty($nomePromocao) || empty($precoPromocional) || empty($dataValidade)) {
    echo json_encode(['status' => 'erro', 'message' => 'Preencha todos os campos.']);
    exit();
}

if (!is_numeric($precoPromocional)) {
    echo json_encode(['status' => 'erro', 'message' => 'O preço deve ser um número.']);
    exit();
}

if ($precoPromocional < 0.10 || $precoPromocional >= $precoOriginal) {
    echo json_encode(['status' => 'erro', 'message' => 'O preço deve ser maior que 0.10 e menor que o preço original.']);
    exit();
}

if (strlen($nomePromocao) < 3 || strlen($nomePromocao) > 20) {
    echo json_encode(['status' => 'erro', 'message' => 'O nome deve ter entre 3 e 20 caracteres. ' . $nomePromocao]);
    exit();
}

require_once('../../classes/promocoes.php');
$promocoes = new Promocoes();
$promocoes->nome_promocao = $nomePromocao;
$promocoes->preco_promocional = $precoPromocional;
$promocoes->data_validade = $dataValidade;
$promocoes->id_item_fk = $idItemFk;
$promocoes->status = 1;

if ($promocoes->cadastrar()){
    echo json_encode(['status' => 'sucesso', 'message' => 'Promoção cadastrada com sucesso.']);
    exit();
}else{
    echo json_encode(['status' => 'erro', 'message' => 'Não foi possível cadastrar a promoção.']);
    exit();
}

?>