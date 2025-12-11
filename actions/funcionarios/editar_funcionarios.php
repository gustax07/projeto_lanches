<?php

if(isset($_SERVER['REQUEST_METHOD']) == 'POST'){
    require_once('../../classes/usuarios.class.php');
    $funcionarios = new Usuarios();
    if ($_POST['nome'] == '') {
        echo "O nome não pode ser vazio.";
        exit;
    }elseif ($_POST['email'] == '') {
        echo "O email não pode ser vazio.";
        exit;
    }elseif ($_POST['id_tipo_fk'] == '') {
        echo "O cargo não pode ser vazio.";
        exit;
    }
    $funcionarios->id = $_GET['id'];
    $funcionarios->nome = $_POST['nome'];
    $funcionarios->email = $_POST['email'];
    $funcionarios->id_tipo_fk = $_POST['id_tipo_fk'];
    if ($funcionarios->Editar()) {
        header('Location: ../../admin/gerenciar_funcionarios.php?msg=funcionario_editado&id_tipo_fk=-1');
    }else{
        header('Location: ../../admin/gerenciar_funcionarios.php?err=funcionario_editar_falha');
    }
}

?>