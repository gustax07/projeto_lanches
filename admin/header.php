<?php
session_start();

if ($_SESSION['usuario']['id_tipo_fk'] == 0) {
    header('Location: ../index.php');
    exit;
} 
$foto = $_SESSION['usuario']['foto'];

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
            text-decoration: none !important;
            color: black !important;
            font-weight: bold;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            transition: all 0.3s ease-in-out !important;
            font-size: 18px ;
        }

        a:hover {
            font-weight: bold !important;
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

        img {
            border: 1px solid black !important;
            border-radius: 120px !important;
        }
    </style>
</head>

<body>
   <nav class="navbar navbar-expand-lg bg-body-tertiary shadow-lg py-2">
    <div class="container-fluid px-4">
        
        <a class="navbar-brand d-flex align-items-center fs-2 fw-bold" href="../index.php">
            <img src="../images/icon_burguer.png" alt="Logo" width="65" height="60" class="me-3 d-inline-block align-text-top">
            Tasty Burger   
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuNavegacao" aria-controls="menuNavegacao" aria-expanded="false" aria-label="Alternar navegação">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="menuNavegacao">
            
            <ul class="navbar-nav mx-auto gap-3 fs-5 text-center mt-3 mt-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="index.php"><i class="bi bi-house-door-fill"></i> Inicial</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="pedidos.php"><i class="bi bi-basket-fill"></i> Pedidos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="gerenciar_funcionarios.php"><i class="bi bi-people-fill"></i> Funcionários</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="gerenciar_categorias.php"><i class="bi bi-tags-fill"></i> Categorias</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="gerenciar_produtos.php"><i class="bi bi-basket-fill"></i> Produtos</a>
                </li>
            </ul>
           
            <div class="d-flex justify-content-center align-items-center mt-3 mt-lg-0">
                <button class="btn btn-light d-flex align-items-center gap-2 border-0 shadow-sm rounded-pill px-3 py-2" data-bs-toggle="collapse" data-bs-target="#perfil" aria-expanded="false" aria-controls="collapseOne">
                    <img src="../images/<?= $foto ?>" alt="Foto" width="40" height="40" class="rounded-circle object-fit-cover">
                    <span class="fs-6 fw-bold mb-0 text-dark"><?= $_SESSION['usuario']['nome'] ?></span>
                </button>
            </div>

        </div>
    </div>
</nav>
    <div class="container-fluid d-flex justify-content-end">
    <div class="collapse" id="perfil">
        <div class="card card-body">
            <a class="mb-1" href="#"><i class="bi bi-gear-fill"></i> Configuracoes</a>
            <a class="mb-1"href="../actions/funcionarios/sair_funcionarios.php"><i class="bi bi-box-arrow-left"></i> Sair</a>
        </div>
    </div>
    </div>

    <?php include_once("../includes/bootstrap_include.php"); 
    include('../includes/sweet_alert2_include.php');?>
    
</body>

</html>