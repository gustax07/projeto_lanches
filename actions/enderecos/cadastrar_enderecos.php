<?php
require_once __DIR__ . '/../../vendor/autoload.php';
use App\Enderecos;
$enderecos = new Enderecos();
session_start();


if (!isset($_SESSION['usuario'])) {
    header('Location: ../../index.php');
    exit;
} else {
    $idUsuario = $_SESSION['usuario']['id'];
    $enderecos->id_usuarios_fk = $idUsuario;
    $enderecos->rua = strip_tags($_POST['rua']);
    $enderecos->numero = strip_tags($_POST['numero']);
    $enderecos->bairro = strip_tags($_POST['bairro']);
    $enderecos->cidade = strip_tags($_POST['cidade']);
    $enderecos->estado = strip_tags($_POST['estado']);
    $enderecos->cep = strip_tags($_POST['cep']);
    if ($enderecos->rua == '') {
        header("location: ../../enderecos.php?err=rua_vazia");
        exit();
    } elseif ($enderecos->numero == '') {
        header("location: ../../enderecos.php?err=numero_vazio");
        exit();
    } elseif ($enderecos->bairro == '') {
        header("location: ../../enderecos.php?err=bairro_vazio");
        exit();
    } elseif ($enderecos->cidade == '') {
        header("location: ../../enderecos.php?err=cidade_vazio");
        exit();
    } elseif ($enderecos->estado == '') {
        header("location: ../../enderecos.php?err=estado_vazio");
        exit();
    } elseif ($enderecos->cep == '') {
        header("location: ../../enderecos.php?err=cep_vazio");
        exit();
    } else {
        $enderecos->Cadastrar();
        header('Location: ../../enderecos.php?msg=endereco_cadastrado');
        exit();
    }
}
