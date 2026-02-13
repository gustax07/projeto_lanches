<?php

require_once('../../classes/usuarios.class.php');

$usuarios = new Usuarios();
$email = $usuarios->email = $_POST['email'];
$senha =$usuarios->senha = $_POST['senha'];

if(empty($email)){
    header('Location: ../../admin/logar.php?err=email_vazio');
}elseif(empty($senha)){
    header('Location: ../../admin/logar.php?err=senha_vazio');
}else
if(sizeof($usuarios->Logar()) == 0){
    header('Location: ../../admin/logar.php?err=email_ou_senha_incorretos');
}else{
    
    session_start();
    $_SESSION['usuario'] = $usuarios->Logar()[0];
    
    if ($_SESSION['usuario']['id_tipo_fk'] == 0) {
        // cliente
        header('Location: ../../index.php');
    } else {
        // funcionário
        header('Location: ../../admin');
    }
    
}

?>