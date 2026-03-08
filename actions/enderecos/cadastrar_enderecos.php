<?php
session_start();

include('../../classes/enderecos.class.php');


if (!isset($_SESSION['usuario'])) {
    header('Location: ../../index.php');
    exit;
} else {
    $idUsuario = $_SESSION['usuario']['id'];
    $enderecos = new Enderecos();
    $enderecos->id_usuarios_fk = $idUsuario;
    $enderecos->rua = $_POST['rua'];
    $enderecos->numero = $_POST['numero'];
    $enderecos->bairro = $_POST['bairro'];
    $enderecos->cidade = $_POST['cidade'];
    $enderecos->estado = $_POST['estado'];
    $enderecos->cep = $_POST['cep'];
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
