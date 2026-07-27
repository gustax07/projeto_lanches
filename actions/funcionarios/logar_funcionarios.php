<?php
require_once '../captcha.php';
require_once __DIR__ . '/../../vendor/autoload.php';

use App\Usuarios;

$usuarios = new Usuarios();

header('Content-Type: text/html; charset=utf-8');

$dados = json_decode(file_get_contents('php://input'), true);
$email = strip_tags($dados['email']);
$senha = $dados['senha'];
$captcha = $dados['recaptcha'];

if (empty($email) || empty($senha)) {
    echo json_encode(['status' => 'erro', 'message' => 'Preencha todos os campos']);
    exit();
}

$usuarios->email = $email;
$usuarios->senha = $senha;
$login = $usuarios->Logar();

if ($login) {
    $tempo = 1209600;
    ini_set('session.gc_maxlifetime', $tempo);
    session_set_cookie_params($tempo);
    session_start();
    session_regenerate_id(true);
    $_SESSION['usuario'] = $usuarios->Logar()[0];
    echo json_encode(['status' => 'sucesso', 'message' => 'Login realizado com sucesso']);
} else {
    echo json_encode(['status' => 'erro', 'message' => 'Email ou senha incorretos']);
}
