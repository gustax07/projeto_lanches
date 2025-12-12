<?php

session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: ./logar.php');
    exit();
}
require_once('../classes/pedidos.class.php');
$pedidos = new Pedidos();
$pedidos_listar = $pedidos->ListarInnerJoin();
//contar a quantidade de pedidos atraves da quantidade de linhas do array
$quantidade_pedidos = count($pedidos_listar);

require_once('../classes/itens.class.php');
$itens = new Itens();
$itens_listar = $itens->Listar();
//contar a quantidade de itens atraves da quantidade de linhas do array
$quantidade_itens = count($itens_listar);

require_once('../classes/categorias.class.php');
$categorias = new Categorias();
$categorias_listar = $categorias->Listar();
//contar a quantidade de categorias atraves da quantidade de linhas do array
$quantidade_categorias = count($categorias_listar);

require_once('../classes/tipos.class.php');
$tipos = new Tipos();
$tipos_listar = $tipos->Listar();
//contar a quantidade de tipos atraves da quantidade de linhas do array
$quantidade_tipos = count($tipos_listar);


require_once('../classes/usuarios.class.php');
$usuarios = new Usuarios();
$usuarios_listar = $usuarios->Listar();
//contar a quantidade de usuarios atraves da quantidade de linhas do array
$quantidade_usuarios = count($usuarios_listar);

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Administrador</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <style>
        .box {
            width: 200px;
            height: 150px;
            background-color: rgb(43, 65, 88);
            border: 1px solid black;
            font-size: 20px;
            font-weight: bold;
            color: white;
            border-radius: 5px;
            box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3);
        }
        .box:hover {
            transform: scale(1.1);
            transition: all 0.3s ease-in-out;
        }
    </style>
</head>

<body style="margin:0; padding: 0;">
    <div class="row g-0">
        <div class="col-auto" style="max-width: 220px;">
            <div class="card">
                <div class="bg-dark p-2 text-light">
                    <div class="card-body " style="height: 100vh;">
                        <div class="vstack gap-3 w-100">
                            <a href="painel.php" class="btn btn-dark btn-lg"><i class="bi bi-bar-chart-line-fill"></i></a>
                            <a href="tipos.php" class="btn btn-dark btn-lg">Pedidos</a>
                            <a href="categorias.php" class="btn btn-dark btn-lg">Categorias</a>
                            <a href="gerenciar_funcionarios.php?id_tipo_fk=-1" class="btn btn-dark btn-lg">Funcionarios</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container col mt-1">
            <div class="card">
                <div class="card-body">
                    <h1 class="text-center">Painel Administrador</h1>
                </div>
            </div>
            <div class="col-auto d-flex flex-wrap justify-content-center align-content-start mt-5 gap-5">
                <div class="box d-flex flex-column justify-content-center align-items-center">
                    <h1><?= $quantidade_pedidos ?> <i class="bi bi-cart-check-fill"></i></h1>
                    <p>Pedidos</p>
                </div>
                <div class="col-auto">
                    <div class="box d-flex flex-column justify-content-center align-items-center">
                        <h1><?= $quantidade_usuarios ?> <i class="bi bi-people-fill"></i></h1>
                        <p>Usuarios</p>
                    </div>
                </div>
                <div class="col-auto">
                    <div class="box d-flex flex-column justify-content-center align-items-center">
                        <h1><?= $quantidade_categorias ?> <i class="bi bi-list"></i></h1>
                        <p>Categorias</p>
                    </div>
                </div>
                <div class="col-auto">
                    <div class="box d-flex flex-column justify-content-center align-items-center">
                        <h1><?= $quantidade_tipos ?> <i class="bi bi-feather"></i></h1>
                        <p>Cargos</p>
                    </div>
                </div>
            </div>
        </div>
    </div>





    <?php include_once("../includes/bootstrap_include.php"); ?>

</body>

</html>