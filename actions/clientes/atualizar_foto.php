<?php
session_start();
require_once('../../classes/usuarios.class.php');

if (!isset($_SESSION['usuario'])) {
    header('Location: /login.php');
    exit;
}

$foto = $_FILES['foto'];

/* Pega a extensão da imagem */
$extensao = pathinfo($foto['name'], PATHINFO_EXTENSION);

/* Cria um nome novo para a foto */
$nomeFoto = 'user_' . $_SESSION['usuario']['id'] . '.' . $extensao;

$pasta = '../../images/';

move_uploaded_file($foto['tmp_name'], $pasta . $nomeFoto);

$usuarios = new Usuarios();
$usuarios->id = $_SESSION['usuario']['id'];
$usuarios->foto = $nomeFoto;
$usuarios->MudarFoto();

/* Atualiza a sessão */
$_SESSION['usuario']['foto'] = $nomeFoto;

/* Volta para o site */
header('Location: ../../index.php');
exit;
