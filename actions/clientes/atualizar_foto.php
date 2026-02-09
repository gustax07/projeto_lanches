<?php
session_start();
require_once('../../classes/usuarios.class.php');

/* Verifica se o usuário está logado */
if (!isset($_SESSION['usuario'])) {
    header('Location: /login.php');
    exit;
}

/* Pega o arquivo enviado */
$foto = $_FILES['foto'];

/* Pega a extensão da imagem */
$extensao = pathinfo($foto['name'], PATHINFO_EXTENSION);

/* Cria um nome novo para a foto */
$nomeFoto = 'user_' . $_SESSION['usuario']['id'] . '.' . $extensao;

/* Pasta onde a imagem será salva */
$pasta = '../../images/';

/* Move a foto para a pasta */
move_uploaded_file($foto['tmp_name'], $pasta . $nomeFoto);

/* Atualiza no banco */
$usuarios = new Usuarios();
$usuarios->id = $_SESSION['usuario']['id'];
$usuarios->foto = $nomeFoto;
$usuarios->MudarFoto();

/* Atualiza a sessão */
$_SESSION['usuario']['foto'] = $nomeFoto;

/* Volta para o site */
header('Location: ../../index.php');
exit;
