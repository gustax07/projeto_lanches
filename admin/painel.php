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
    <style>
        iframe {
            display: block;
        }

        .sidebar {
            width: 220px;
            transition: width 0.3s ease;
        }

        .sidebar.minimized {
            width: 70px;
        }

        .sidebar .menu-text {
            transition: opacity 0.2s ease;
        }

        .sidebar.minimized .menu-text {
            opacity: 0;
            display: none;
        }
    </style>
</head>

<body style="margin:0; padding:0;">

    <header class="container-fluid col-auto">
        <div class="card">
            <div class="card-body">
                <h1 class="text-center">Painel Administrador</h1>
            </div>
        </div>
    </header>

    <div class="container-fluid px-0">
        <div class="row g-0">

            <!-- SIDEBAR -->
            <aside class="col-auto bg-dark" style="width:220px;" id="sidebar">
                <div class="p-2 text-light">
                    <a href="painel.php" class="btn btn-dark btn-lg">
                        <i class="bi bi-bar-chart-line-fill"></i>
                        Painel
                    </a>
                    <a href="pedidos.php" target="#pedidos" class="btn btn-dark btn-lg">
                        <i class="bi bi-cart-check-fill"></i>
                        Pedidos
                    </a>
                    <a href="categorias.php" class="btn btn-dark btn-lg">
                        <i class="bi bi-list"></i>
                        Categorias
                    </a>
                    <a href="gerenciar_funcionarios.php?id_tipo_fk=-1" class="btn btn-dark btn-lg">
                        <i class="bi bi-people-fill"></i>
                        Funcionários
                    </a>
                </div>
            </aside>

            <!-- CONTEÚDO -->

            <main class="col p-0 mt-3">
                <iframe
                    src="./dashboard.php"
                    style="width:100%; height:100vh; border:none;"
                    id="pedidos">
                </iframe>
            </main>
        </div>


    </div>
    <?php include_once("../includes/bootstrap_include.php"); ?>
    <script>
    document.getElementById('toggleMenu').addEventListener('click', function () {
        document.getElementById('sidebar').classList.toggle('minimized');
    });
</script>

</body>


</html>