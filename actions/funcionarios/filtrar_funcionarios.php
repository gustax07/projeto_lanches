<?php

include('../../classes/usuarios.class.php');
$usuarios = new Usuarios();
$usuarios->id_tipo_fk = $_POST['id_tipo_fk'] ?? -1;
$usuarios->ListarPorIDCargo();

if ($usuarios->id_tipo_fk == 0) {
    header('Location: ../../admin/gerenciar_funcionarios.php');
} else{
    header('Location: ../../admin/gerenciar_funcionarios.php?id_tipo_fk=' . $usuarios->id_tipo_fk);
}

?>