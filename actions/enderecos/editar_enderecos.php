<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header('Location: ../../index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../../enderecos.php');
    exit;
}

require_once('../../classes/enderecos.class.php');

$idUsuario  = $_SESSION['usuario']['id'];
$idEndereco = $_POST['id'] ?? null;

if (!$idEndereco) {
    header('Location: ../../enderecos.php');
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

if (
    empty($enderecos->rua) ||
    empty($enderecos->numero) ||
    empty($enderecos->bairro) ||
    empty($enderecos->cidade) ||
    empty($enderecos->estado) ||
    empty($enderecos->cep)
) {
    header("Location: ../../editar_endereco.php?id=$idEndereco");
    exit;
}

$endereco = $enderecos->BuscarPorId($idEndereco, $idUsuario);
if (!$endereco || count($endereco) === 0) {
    header('Location: ../../enderecos.php');
    exit;
}

$enderecos->Editar();

header('Location: ../../enderecos.php?sucesso=editado');
exit;
