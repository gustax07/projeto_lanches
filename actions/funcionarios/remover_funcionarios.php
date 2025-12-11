<?php

require_once('../../classes/usuarios.class.php');
$funcionarios = new Usuarios();
$funcionarios->id = $_GET['id'];

if ($funcionarios->Excluir()){
    header('Location: ../../admin/gerenciar_funcionarios.php?msg=funcionario_excluido&id_tipo_fk=-1');
}else
{
    header('Location: ../../admin/gerenciar_funcionarios.php?err=funcionario_excluir_falha');
}
?>