<?php
require_once __DIR__ . '/../../vendor/autoload.php';
use App\Usuarios;
$funcionarios = new Usuarios();


if (!isset($_GET['id'])){
    header('Location: ../../admin/gerenciar_funcionarios.php');
    exit;
}
$funcionarios->id = $_GET['id'];

if ($funcionarios->Excluir()){
    header('Location: ../../admin/gerenciar_funcionarios.php?msg=funcionario_excluido&id_tipo_fk=-1');
}else
{
    header('Location: ../../admin/gerenciar_funcionarios.php?err=funcionario_excluir_falha');
}
?>