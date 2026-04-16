<?php

header('Content-Type: application/json');

require_once('../../classes/itens.class.php');
$itens = new Itens();

$dados = json_decode(file_get_contents('php://input'), true);
$pagina = isset($dados['pagina']) ? (int)$dados['pagina'] : 1;
$offset = ($pagina -1) * 24;

$itens_listar = $itens->Listar(24, $offset);

if ($itens_listar){
    echo json_encode(['status' => 'sucesso', 'lista' => $itens_listar]);
}else {
    echo json_encode(['status' => 'erro', 'message' => 'Nenhum item Encontrado']);
}
exit();
?>