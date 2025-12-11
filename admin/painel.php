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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    </style>
</head>

<body style="margin:0; border: none; padding: 0;">
    <div class="row">
        <div class="col-auto">
            <div class="card">
                <div class="card-body vh-100 bg-dark">
                    <div class="vstack gap-3" style="width: 100%;">
                        <a href="lanches.php" class="btn btn-dark btn-lg">Lanches</a>
                        <a href="tipos.php" class="btn btn-dark btn-lg">Tipos</a>
                        <a href="categorias.php" class="btn btn-dark btn-lg">Categorias</a>
                        <a href="funcionarios.php" class="btn btn-dark btn-lg">Funcionarios</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-auto">
                            <h5 class="card-title">Painel Administrador</h5>
                            <p class="card-text">Bem vindo ao painel administrador</p>
                        </div>
                        
                            <div class="col-auto">
                                <a href="gerenciar_funcionarios.php" class="btn btn-danger">Sair</a>
                            </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include_once("../includes/bootstrap_include.php"); ?>

</body>

</html>