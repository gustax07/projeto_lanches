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
        echo "rua não pode estar vazia";
    } elseif ($enderecos->numero == '') {
        echo "numero nao pode estar vazio";
    } elseif ($enderecos->bairro == '') {
        echo "bairro nao pode estar vazio";
    } elseif ($enderecos->cidade == '') {
        echo "cidade nao pode estar vazio";
    } elseif ($enderecos->estado == '') {
        echo "estado nao pode estar vazio";
    } elseif ($enderecos->cep == '') {
        echo "cep nao pode estar vazio";
    } else {
        $enderecos->Cadastrar();
        header('Location: ../../enderecos.php');
    }
}
