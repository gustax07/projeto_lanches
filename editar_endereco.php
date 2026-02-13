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

    <style>
        body {
            margin: 0;
            min-height: 100vh;
            background: #f2f2f2;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .card {
            background: #fff;
            width: 100%;
            max-width: 420px;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }

        .card h3 {
            margin-bottom: 20px;
            text-align: center;
            color: #333;
        }

        .campo {
            display: flex;
            flex-direction: column;
            margin-bottom: 15px;
        }

        .campo label {
            font-size: 14px;
            margin-bottom: 5px;
            color: #555;
        }

        .campo input {
            padding: 10px;
            border-radius: 6px;
            border: 1px solid #ccc;
            font-size: 15px;
        }

        .campo input:focus {
            outline: none;
            border-color: #ff9800;
            box-shadow: 0 0 0 2px rgba(255,152,0,0.2);
        }

        button {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 8px;
            background: linear-gradient(135deg, #ff9800, #ff6f00);
            color: #fff;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover {
            opacity: 0.9;
            transform: translateY(-1px);
        }
    </style>
</head>

<body>

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

</body>
</html>
