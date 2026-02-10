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


if (!empty($novaSenha)) {

    
    if (hash('sha256', $senhaAtual) != $_SESSION['usuario']['senha']) {
        die('Senha atual incorreta');
    }

    
    if ($novaSenha != $confirmarSenha) {
        die('As senhas não coincidem');
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

header('Location: ../../seguranca.php');
exit;

?>
