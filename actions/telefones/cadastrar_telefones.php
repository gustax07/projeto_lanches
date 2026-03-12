<?php
session_start();

if (!isset($_SESSION['usuario']['id'])) {
    header('Location: ../../logar.php');
    exit;
}

require_once('../../classes/telefones.class.php');

$telefones = new Telefones();
$idUsuario = $_SESSION['usuario']['id'];
print_r($_POST);
?>
