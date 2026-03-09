<?php
require_once '../captcha.php';

if (!validarCaptcha($_POST['g-recaptcha-response'])) {
    header("Location: ../../logar.php?err=captcha_invalido");
    exit();
}
require_once('../../classes/usuarios.class.php');

$usuarios = new Usuarios();
$email = $usuarios->email = strip_tags( $_POST['email']);
$senha = $usuarios->senha = strip_tags($_POST['senha']);

if (empty($email)) {
    header('Location: ../../logar.php?err=email_vazio');
} elseif (empty($senha)) {
    header('Location: ../../logar.php?err=senha_vazio');
} else
            if (sizeof($usuarios->Logar()) == 0) {
    header('Location: ../../logar.php?err=email_ou_senha_incorretos');
} else {

    $tempo = 1209600;
    ini_set('session.gc_maxlifetime', $tempo);
    session_set_cookie_params($tempo);
    session_start();
    session_regenerate_id(true);
    $_SESSION['usuario'] = $usuarios->Logar()[0];

    if ($_SESSION['usuario']['id_tipo_fk'] == 0) {
        // cliente
        header('Location: ../../index.php');
    } else {
        // funcionário
        header('Location: ../../admin');
    }
}
