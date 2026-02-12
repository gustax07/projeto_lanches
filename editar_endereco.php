<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header('Location: index.php');
    exit;
}

require_once('classes/enderecos.class.php');

if (!isset($_GET['id'])) {
    header('Location: enderecos.php');
    exit;
}

$idEndereco = $_GET['id'];
$idUsuario  = $_SESSION['usuario']['id'];

$enderecos = new Enderecos();
$endereco = $enderecos->BuscarPorId($idEndereco, $idUsuario);

if (!$endereco) {
    header('Location: enderecos.php');
    exit;
}
$lista = $enderecos->BuscarPorId($idEndereco, $idUsuario);
if (!$lista || count($lista) === 0) {
    header('Location: enderecos.php');
    exit;
}

$endereco = $lista[0];
?>


<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Endereço</title>
</head>

<body>

<h3>Editar Endereço</h3>

<form method="POST" action="actions/enderecos/editar_endereco.php">

    <input type="hidden" name="id" value="<?= $endereco['id'] ?>">

    <label>Rua</label>
    <input type="text" name="rua" value="<?= $endereco['rua'] ?>">

    <label>Número</label>
    <input type="text" name="numero" value="<?= $endereco['numero'] ?>">

    <label>Bairro</label>
    <input type="text" name="bairro" value="<?= $endereco['bairro'] ?>">

    <label>Cidade</label>
    <input type="text" name="cidade" value="<?= $endereco['cidade'] ?>">

    <label>Estado</label>
    <input type="text" name="estado" value="<?= $endereco['estado'] ?>">

    <label>CEP</label>
    <input type="text" name="cep" value="<?= $endereco['cep'] ?>">

    <button type="submit">Salvar Alterações</button>

</form>

</body>
</html>
