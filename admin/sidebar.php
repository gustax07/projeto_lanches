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
    <!-- importar o arquivo css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/painel.css">

    <title>Painel Administrador</title>
    <style>
        iframe {
            display: block;
        }
    </style>
</head>

<body style="margin:0; padding:0;">

    <div class="area"></div>
    <nav class="main-menu">
        <ul>
            <li>
                <a href="./dashboard.php" target="_self">
                    <i class="fa fa-home fa-2x"></i>
                    <span class="nav-text">
                        Tela Inicial
                    </span>
                </a>

            </li>
            <li class="has-subnav">
                <a href="./pedidos.php" target="_self">
                    <i class="fa fa-globe fa-2x"></i>
                    <span class="nav-text">
                        Pedidos
                    </span>
                </a>

            </li>
            <li class="has-subnav">
                <a href="#">
                    <i class="fa fa-comments fa-2x"></i>
                    <span class="nav-text">
                        Cardapio
                    </span>
                </a>

            </li>
            <li class="has-subnav">
                <a href="#">
                    <i class="fa fa-camera-retro fa-2x"></i>
                    <span class="nav-text">
                        Funcionarios
                    </span>
                </a>

            </li>
            <li>
                <a href="#">
                    <i class="fa fa-film fa-2x"></i>
                    <span class="nav-text">
                        Feedbacks
                    </span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fa fa-book fa-2x"></i>
                    <span class="nav-text">
                        Cupons & Descontos
                    </span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fa fa-cogs fa-2x"></i>
                    <span class="nav-text">
                        Tickets
                    </span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fa fa-map-marker fa-2x"></i>
                    <span class="nav-text">
                        Configuracoes
                    </span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fa fa-info fa-2x"></i>
                    <span class="nav-text">
                        Contato ao Suporte
                    </span>
                </a>
            </li>
        </ul>

        <ul class="logout">
            <li>
                <a href="#">
                    <i class="fa fa-power-off fa-2x"></i>
                    <span class="nav-text">
                        Sair da Conta
                    </span>
                </a>
            </li>
        </ul>
    </nav>

        
 
    <?php include_once("../includes/bootstrap_include.php"); ?>
        
</body>

</html>