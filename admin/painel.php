<?php

session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: ./logar.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Administrador</title>
</head>

<body>
    <div class="card">
        <div class="card-body">
            <div class="row align-items-center justify-content-center">
                <div class="col-auto">
                    <h1>Painel Administrador</h1>
                </div>
                <div class="col-auto d-flex justify-content-end">
                    <a class="btn btn-danger" href="../actions/funcionarios/sair_funcionarios.php">Sair</a>
                </div>
            </div>
        </div>
    </div>
    <div class="text-center">
        <h2>Ola, Administrador</h2>
    </div>
    <div class="">
    <h4>Painel de Controle</h4>
    <a class="btn btn-dark" href="./gerenciar_funcionarios.php?id_tipo_fk=-1">Gerenciar Funcionarios</a>
    <a class="btn btn-dark" href="./gerenciar_lanches.php">Gerenciar Lanches</a>
    <a class="btn btn-dark" href="./gerenciar_pedidos.php">Gerenciar Pedidos</a>

    <?php
    include_once("../includes/bootstrap_include.php")
    ?>
</body>

</html>