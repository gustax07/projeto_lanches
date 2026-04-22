<?php
require_once __DIR__ . '/../../vendor/autoload.php';
use App\Usuarios;
$usuarios = new Usuarios();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../../index.php?err=acesso_nao_autorizado');
    exit;
}

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


if (!isset($_SESSION['usuario'])) {
    header('Location: /logar.php');
    exit;
}


$foto = $_FILES['foto'];
if (empty($foto['name'])) {
    header('Location: ../../index.php?err=foto_vazia');
    exit;
}
/* Pega a extensão da imagem */
$extensao = pathinfo($foto['name'], PATHINFO_EXTENSION);

/* Cria um nome novo para a foto */
$nomeFoto = 'user_' . $_SESSION['usuario']['id'] . '.' . $extensao;

$pasta = '../../images/';

move_uploaded_file($foto['tmp_name'], $pasta . $nomeFoto);

$usuarios->id = $_SESSION['usuario']['id'];
$usuarios->foto = $nomeFoto ?? 'foto_perfil_default.png';

if ($usuarios->MudarFoto()) {
    header('Location: ../../index.php?err=foto_atualizada');
    $_SESSION['usuario']['foto'] = $nomeFoto;
    exit;
}else {
    header('Location: ../../index.php?err=falha_atualizar_foto');
    exit;
}
?>
