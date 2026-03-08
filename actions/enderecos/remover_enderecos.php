<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header('Location: ../../index.php');
    exit;
}

require_once('../../classes/enderecos.class.php');

if (!isset($_GET['id'])) {
    header('Location: ../../enderecos.php');
    exit;
}

$enderecos = new Enderecos();
$enderecos ->id = $_GET['id'];

if($enderecos->Excluir())
    {
        header('Location: ../../enderecos.php?msg=endereco_excluido');
        exit;
    };

header('Location: ../../enderecos.php');
exit;