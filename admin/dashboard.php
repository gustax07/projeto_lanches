<?php
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

//contar a quantidade de clientes atraves da quantidade de linhas do array
$usuario_cliente = $usuarios->ListarClientes();
$quantidade_clientes = count($usuario_cliente);

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <style>
        .box {
            width: 150px;
            margin: 10px;
            height: 150px;
            background-color: rgb(43, 65, 88);
            border: 1px solid black;
            font-size: 20px;
            font-weight: bold;
            color: white;
            border-radius: 5px;
            box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .box h1 {
            margin-bottom: 10px;
        }

        .box p {
            margin: 0;
        }

        .box:hover {
            transform: scale(1.1);
            transition: all 0.3s ease-in-out;
        }
    </style>
</head>

<body style="margin:0; padding: 0;">
    <main class="container mt-5">
        <div class="row align-items-center">

            <?php if (isset($quantidade_pedidos)) : ?>
                <div class="box col-12 col-sm-3 col-md-2">
                    <h1><?= $quantidade_pedidos ?> <i class="bi bi-cart-check-fill"></i></h1>
                    <p>Pedidos</p>
                </div>
            <?php endif; ?>

            <?php if (isset($quantidade_usuarios)) : ?>
                <div class="box col-12 col-sm-3 col-md-2">
                    <h1><?= $quantidade_usuarios ?> <i class="bi bi-people-fill"></i></h1>
                    <p>Usuários</p>
                </div>
            <?php endif; ?>

            <?php if (isset($quantidade_categorias)) : ?>
                <div class="box col-12 col-sm-3 col-md-2">
                    <h1><?= $quantidade_categorias ?> <i class="bi bi-list"></i></h1>
                    <p>Categorias</p>
                </div>
            <?php endif; ?>

            <?php if (isset($quantidade_tipos)) : ?>
                <div class="box col-12 col-sm-3 col-md-2">
                    <h1><?= $quantidade_tipos ?> <i class="bi bi-feather"></i></h1>
                    <p>Cargos</p>
                </div>
            <?php endif; ?>

            <?php if (isset($quantidade_clientes)) : ?>
                <div class="box col-12 col-sm-3 col-md-2">
                    <h1><?= $quantidade_clientes ?> <i class="bi bi-eyeglasses"></i></h1>
                    <p>Clientes</p>
                </div>
            <?php endif; ?>

        </div>
    </main>
    <?php include_once("../includes/bootstrap_include.php"); ?>
</body>


</html>