<?php 

session_start();
require_once('../../classes/usuarios.class.php');

$usuario = new Usuarios();

$usuario->id    = $_SESSION['usuario']['id'];
$usuario->nome  = $_POST['nome'];
$usuario->email = $_POST['email'];
$senhaAtual     = $_POST['senhaAtual'] ?? '';
$novaSenha      = $_POST['senha'] ?? '';
$confirmarSenha = $_POST['confirmarSenha'] ?? '';

if($usuario->nome == ''){
        header('Location: ../../seguranca.php?err=nome_vazio');
        exit;
    }

    else if($usuario->email == ''){
        header('Location: ../../seguranca.php?err=email_vazio');
        exit;
    }

if (!empty($novaSenha)) {

    
    if (hash('sha256', $senhaAtual) != $_SESSION['usuario']['senha']) {
        header('Location: ../../seguranca.php?err=senha_nao_confere');
        exit;
    }

    
    if ($novaSenha != $confirmarSenha) {
        header('Location: ../../seguranca.php?err=senha_nao_confere');
        exit;
    }

    $usuario->senha = $novaSenha;
} else {
    $usuario->senha = null;
}

$usuario->Editar();
$_SESSION['usuario']['nome']  = $usuario->nome;
$_SESSION['usuario']['email'] = $usuario->email;

if (!empty($novaSenha)) {
    $_SESSION['usuario']['senha'] = hash('sha256', $novaSenha);
}

header('Location: ../../seguranca.php?msg=conta_editada');
exit;

?>
