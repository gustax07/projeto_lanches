<?php
require_once __DIR__ . '/../../vendor/autoload.php';
use App\Enderecos;
$enderecos = new Enderecos();
session_start();

if (!isset($_SESSION['usuario'])) {
    header('Location: ../../index.php');
    exit;
}


if (!isset($_GET['id'])) {
    header('Location: ../../enderecos.php');
    exit;
}

$enderecos ->id = $_GET['id'];

if($enderecos->Excluir())
    {
        header('Location: ../../enderecos.php?msg=endereco_excluido');
        exit;
    };

header('Location: ../../enderecos.php');
exit;