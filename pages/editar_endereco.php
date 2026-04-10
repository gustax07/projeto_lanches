<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: index.php');
    exit;
}


if (!isset($_GET['id'])) {
    header('Location: enderecos.php');
    exit;
}
require_once('classes/enderecos.class.php');

$idEndereco = $_GET['id'];
$idUsuario  = $_SESSION['usuario']['id'];

$enderecos = new Enderecos();
$lista = $enderecos->BuscarPorId($idEndereco, $idUsuario);

if (!$lista || count($lista) === 0) {
    header('Location: enderecos.php');
    exit;
}

$endereco = $lista[0];
?>

<title>Editar Endereço</title>
<link rel="stylesheet" href="css/editar_endereco.css">

<div class="edit_endereco">
    <div class="header-backgroud"></div>

    <div class="container d-flex justify-content-center mb-5">
        <div class="card">
            <h3>Editar Endereço</h3>

            <form method="POST" action="actions/enderecos/editar_enderecos.php">

                <input type="hidden" name="id" value="<?= $endereco['id'] ?>">

                <div class="campo">
                    <label>Rua</label>
                    <input type="text" name="rua" value="<?= $endereco['rua'] ?>">
                </div>

                <div class="campo">
                    <label>Número</label>
                    <input type="text" name="numero" value="<?= $endereco['numero'] ?>">
                </div>

                <div class="campo">
                    <label>Bairro</label>
                    <input type="text" name="bairro" value="<?= $endereco['bairro'] ?>">
                </div>

                <div class="campo">
                    <label>Cidade</label>
                    <input type="text" name="cidade" value="<?= $endereco['cidade'] ?>">
                </div>

                <div class="campo">
                    <label>Estado</label>
                    <input type="text" name="estado" value="<?= $endereco['estado'] ?>">
                </div>

                <div class="campo">
                    <label>CEP</label>
                    <input type="text" name="cep" value="<?= $endereco['cep'] ?>">
                </div>

                <button type="submit">Salvar Alterações</button>

            </form>
        </div>
    </div>
</div>