<?php

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/painel.css">

    <title>Painel Administrador</title>
    <style>

        a {
            text-decoration: none;
            color: black;
            font-weight: bold;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            transition: all 0.3s ease-in-out !important;
            font-size: 18px !important;
        }

        a:hover {
            font-weight: bold;
            transform: translateY(-5px);
            cursor: pointer;
        }

        navbar-brand {
            font-weight: bold;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .tasty {
            font-size: 48px;
        }
    </style>
</head>

<body>
    <nav class="navbar-expand-lg bg-text-light bg-body-tertiary shadow-lg py-3">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <div class="tasty">
                    <img src="../images/icon_burguer.png" alt="Logo" width="65" height="60" class="d-inline-block align-text-top">
                    Tasty Burger
                </div>
            </a>
            <div class="row align-items-center">
                <div class="col d-flex gap-3 mt-2 flex-wrap nowrap">
                    <a class="nav-link" aria-current="page" href="index.php">Pagina Inicial</a>
                    <a class="nav-link" aria-current="page" href="pedidos.php">Pedidos</a>
                    <a class="nav-link" aria-current="page" href="gerenciar_funcionarios.php">Funcionarios</a>
                    <a class="nav-link" aria-current="page" href="gerenciar_categorias.php">Categorias</a>
                    <a class="nav-link" aria-current="page" href="gerenciar_produtos.php">Produtos</a>
                </div>
                <div class="col-auto" style="background-color: red;">
                    <a class="nav-link" aria-current="page" href="gerenciar_funcionarios.php"> Sair</a>
                </div>
            </div>
        </div>

    </nav>


    <?php include_once("../includes/bootstrap_include.php"); ?>

</body>

</html>