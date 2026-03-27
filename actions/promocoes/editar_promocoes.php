<?php

if ($_SERVER['REQUEST_METHOD'] !== 'POST'){
    header('Location: ../../admin/gerenciar_promocoes.php');
    header('Cache-Control: no-cache, no-store, must-revalidate');
    header('Pragma: no-cache');
    header('Expires: 0');
    exit();
}


$data = json_decode(file_get_contents('php://input'), true);

$id = $data['id'];
$nome = $data['nome'];
$preco = $data['preco'];
$validade = $data['validade'];

if (empty($id) || empty($nome) || empty($preco) || empty($validade)){
    header('Location: ../../admin/gerenciar_promocoes.php');
    exit();

}

require_once('../classes/promocoes.php');
$promocoes = new Promocoes();

?>