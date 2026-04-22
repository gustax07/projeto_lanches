<?php
require_once __DIR__ . '/../../vendor/autoload.php';
use App\Usuarios;
$usuario = new Usuarios();

session_start();

if (!isset($_SESSION['usuario'])) {
  echo json_encode(['status' => 'erro', 'lista' => 'Usuário não encontrado']);
}

$id_usuario = $_SESSION['usuario']['id'] ?? null;

if (empty($id_usuario)){
   echo json_encode(['erro' => 'Usuário não encontrado']);
    exit;
}


$usuario->id = $id_usuario;
$clientes = $usuario->ListarPorID();

if ($clientes){
   echo json_encode(['status' => 'sucesso', 'lista' => $clientes]);
} else {
   echo json_encode(['status' => 'erro', 'lista' => 'Usuário não encontrado']);
}
?>