<?php
require_once __DIR__ . '/../../vendor/autoload.php';
use App\Enderecos;

session_start();

header('Content-Type: application/json');

if (!isset($_SESSION['usuario'])) {
  echo json_encode(['status' => 'erro', 'lista' => 'Usuário não encontrado']);
    exit;
}

$idUsuario = (int) $_SESSION['usuario']['id'];

if (empty($idUsuario)){
   echo json_encode(['erro' => 'Usuário não encontrado']);
    exit;
}

$enderecos = new Enderecos();
$enderecos->id_usuarios_fk = $idUsuario;
$enderecos_listar = $enderecos->ListarPorID();

if ($enderecos_listar){
    echo json_encode(['status' => 'sucesso', 'lista' => $enderecos_listar]);
} else {
    echo json_encode(['status' => 'erro', 'lista' => 'Usuário não encontrado']);
}
