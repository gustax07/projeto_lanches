<?php
require_once '../captcha.php';

if (!validarCaptcha($_POST['g-recaptcha-response'])) {
    header("Location: ../../logar.php?err=captcha_invalido");
    exit();
}
require_once('../../classes/usuarios.class.php');

$clientes = new Usuarios();
$clientes->nome = strip_tags($_POST['nome']);
$clientes->email = strip_tags($_POST['email']);
$clientes->senha = strip_tags($_POST['senha']);
$clientes->data_cadastro = strip_tags(date('Y-m-d'));
$clientes->id_tipo_fk = 0;

if ($clientes->nome == '') {
    header('Location: ../../cadastrar.php?err=nome_vazio');
    exit;
} elseif ($clientes->email == '') {
    header('Location: ../../cadastrar.php?err=email_vazio');
    exit;
} elseif ($clientes->senha == '') {
    header('Location: ../../cadastrar.php?err=senha_vazio');
    exit;
} elseif (count($clientes->Logar()) > 0) {
    header('Location: ../../cadastrar.php?err=email_ja_cadastrado');
    exit;
} elseif ($clientes->Cadastrar()) {
    
} else {
    header('Location: ../../cadastrar.php');
}
