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
$usuarios_listar = $usuarios->ListarFuncionarios();
//contar a quantidade de usuarios atraves da quantidade de linhas do array
$quantidade_usuarios = count($usuarios_listar);

//contar a quantidade de clientes atraves da quantidade de linhas do array
$usuario_cliente = $usuarios->ListarClientes();
$quantidade_clientes = count($usuario_cliente);

include('./sidebar.php');

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela Inicial</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="./css/index.css">
</head>

<body>
    <div class="container mt-5">
    <div class="row">
        <div class="col-6 col-xl-3">
            <div class="card bg-c-blue order-card">
                <div class="card-block">
                    <h6 class="m-b-20">Pedidos</h6>
                    <h2 class="text-right"><i class="fa fa-cart-plus f-left"></i><span><?= $quantidade_pedidos ?></span></h2>
                    <p class="m-b-0">Completed Orders<span class="f-right">351</span></p>
                </div>
            </div>
        </div>
        
        <div class="col-6 col-xl-3">
            <div class="card bg-c-green order-card">
                <div class="card-block">
                    <h6 class="m-b-20">Funcionarios</h6>
                    <h2 class="text-right"><i class="fa fa-rocket f-left"></i><span><?= $quantidade_usuarios ?></span></h2>
                    <p class="m-b-0">Completed Orders<span class="f-right">351</span></p>
                </div>
            </div>
        </div>
        
        <div class="col-6 col-xl-3">
            <div class="card bg-c-yellow order-card">
                <div class="card-block">
                    <h6 class="m-b-20">Categorias</h6>
                    <h2 class="text-right"><i class="fa fa-refresh f-left"></i><span><?= $quantidade_categorias ?></span></h2>
                    <p class="m-b-0">Completed Orders<span class="f-right">351</span></p>
                </div>
            </div>
        </div>
        
        <div class="col-6 col-xl-3">
            <div class="card bg-c-pink order-card">
                <div class="card-block">
                    <h6 class="m-b-20">Cargos</h6>
                    <h2 class="text-right"><i class="fa fa-credit-card f-left"></i><span> <?=  $quantidade_tipos ?></span></h2>
                    <p class="m-b-0">Completed Orders<span class="f-right">351</span></p>
                </div>
            </div>
        </div>
	</div>
</div>
    <?php include_once("../includes/bootstrap_include.php"); ?>
</body>


</html>