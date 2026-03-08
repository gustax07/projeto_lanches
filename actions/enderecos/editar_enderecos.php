<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header('Location: ../../index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../../enderecos.php?err=metodo_invalido');
    exit;
}

require_once('../../classes/enderecos.class.php');

$idUsuario  = $_SESSION['usuario']['id'];
$idEndereco = $_POST['id'] ?? null;

if (!$idEndereco) {
    header('Location: ../../enderecos.php?err=metodo_invalido');
    exit;
}

$enderecos = new Enderecos();

$enderecos->id     = $idEndereco;
$enderecos->rua    = trim($_POST['rua'] ?? '');
$enderecos->numero = trim($_POST['numero'] ?? '');
$enderecos->bairro = trim($_POST['bairro'] ?? '');
$enderecos->cidade = trim($_POST['cidade'] ?? '');
$enderecos->estado = trim($_POST['estado'] ?? '');
$enderecos->cep    = trim($_POST['cep'] ?? '');

if($enderecos->rua == '')
    {
        header('Location: ../../enderecos.php?err=rua_vazia');
        exit;
    }

    if($enderecos->numero == '')
    {
        header('Location: ../../enderecos.php?err=numero_vazio');
        exit;
    }

    if($enderecos->bairro == '')
    {
        header('Location: ../../enderecos.php?err=bairro_vazio');
        exit;
    }

    if($enderecos->cidade == '')
    {
        header('Location: ../../enderecos.php?err=cidade_vazio');
        exit;
    }

    if($enderecos->estado == '')
    {
        header('Location: ../../enderecos.php?err=estado_vazio');
        exit;
    }

    if($enderecos->cep == '')
    {
        header('Location: ../../enderecos.php?err=cep_vazio');
        exit;
    }

$endereco = $enderecos->BuscarPorId($idEndereco, $idUsuario);
if (!$endereco || count($endereco) === 0) {
    header('Location: ../../enderecos.php');
    exit;
}

$enderecos->Editar();

header('Location: ../../enderecos.php?msg=endereco_editado');
exit;
