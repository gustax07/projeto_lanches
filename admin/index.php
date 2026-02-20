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
$funcionarios_listar = $usuarios->ListarFuncionarios();
//contar a quantidade de usuarios atraves da quantidade de linhas do array
$quantidade_funcionarios = count($funcionarios_listar);

//contar a quantidade de clientes atraves da quantidade de linhas do array
$usuario_cliente = $usuarios->ListarClientes();
$quantidade_clientes = count($usuario_cliente);

require_once('../classes/enderecos.class.php');
$enderecos = new Enderecos();
$enderecos_listar = $enderecos->Listar();
//contar a quantidade de enderecos atraves da quantidade de linhas do array
$quantidade_enderecos = count($enderecos_listar);

require_once('../classes/telefones.class.php');
$telefones = new Telefones();
$telefones_listar = $telefones->Listar();
//contar a quantidade de telefones atraves da quantidade de linhas do array
$quantidade_telefones = count($telefones_listar);

require_once('../classes/pedidos_itens.class.php');
$pedidos_itens = new Pedido_Itens();
$produtos_mais_vendidos = $pedidos_itens->listarTop5Vendidos();


// Se estiver no localhost, a raiz é a pasta do projeto. No servidor, é a pasta admin.
$base_path = ($_SERVER['HTTP_HOST'] == 'localhost') ? '/projeto_lanches/' : '/admin/';

include('./sidebar.php');
$meta_pedidos = 200;


//criar uma funcao para os cards
function criarCard($titulo, $quantidade, $meta, $theme, $cor, $icone, $page)
{
    echo '
    <div class="col-6 col-lg-3 col-xl-2">
    <a href="' . $page . '">
    <div class="card order-card" style="background: linear-gradient(45deg,' . $theme . ');">
    <div class="card-block">
        <h4 class="m-b-20">' . $titulo . '</h4>
        <div class="d-flex justify-content-between align-items-center">
            ' . $icone . '
            <h2 class="text-right"><span>' . $quantidade . ' / ' . $meta . '</span></h2>
        </div>
        <div class="d-flex justify-content-between align-items-center">
        <p class="m-b-0">Progresso do Mes</p>
        <span class="m-l-5">' . $quantidade / $meta * 100 . '%</span>
        </div>
        <div class="progress" role="progressbar" aria-valuenow="' . $quantidade / $meta * 100 . '" aria-valuemin="0" aria-valuemax="100">
           <div class="progress-bar progress-bar-animated" style="width: ' . $quantidade / $meta * 100 . '%; background-color:' . $cor . '"></div>
        </div>
    </div>
</div>
</a>
</div>';
}
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

    <!-- card de apresentacao do dashboard  -->



    <div class="container-fluid flex-nowrap flex-wrap mt-5">
        <div class="row justify-content-start">
            <?php
            criarCard('Pedidos', $quantidade_pedidos, $meta_pedidos, "#4099ff,#73b4ff", "#2e8bd8ff", '<i class="bi bi-bag-check-fill"></i>', 'pedidos.php');
            criarCard('Funcionarios', $quantidade_funcionarios, 100, "#2ed8b6,#59e0c5", "#4caf81ff", '<i class="bi bi-people-fill"></i>', 'funcionarios.php');
            criarCard('Clientes', $quantidade_clientes, 100, '#FF5370,#ff869a', "#ff869aff", '<i class="bi bi-people-fill"></i>', 'clientes.php');
            criarCard('Categorias', $quantidade_categorias, 100, '#FFB64D,#ffcb80', "#ffcb80ff", '<i class="bi bi-tags-fill"></i>', 'categorias.php');
            criarCard('Cargos', $quantidade_tipos, 100, "#c850c0,#dd6fd6", "#dd6fd6ff", '<i class="bi bi-tags-fill"></i>', 'tipos.php');
            criarCard('Produtos', $quantidade_itens, 100, "#4CAF50,#8BC34A", "#3dbb41ff", '<i class="bi bi-basket-fill"></i>', 'produtos.php');
            criarCard('Enderecos', $quantidade_enderecos, 100, "#FFB64D,#ffcb80", "#ffcb80ff", '<i class="bi bi-geo-alt-fill"></i>', 'enderecos.php');
            criarCard('Telefones', $quantidade_telefones, 100, "#4099ff,#73b4ff", "#2e8bd8ff", '<i class="bi bi-telephone-fill"></i>', 'telefones.php');
            ?>
        </div>
    </div>
    <hr class="container col-6">
    <!-- lista o produtos mais vendidos -->
    <div class="container-fluid">
        <div class="col-md-3 col-lg-3 displey-flex justify-content-center align-items-center shadow p-3 mt-5 bg-body-white rounded">
            <table class="table table-responsive">
                <h3 class="text-center">Produtos Mais Vendidos</h3>
                <thead class="text-center">
                    <tr>
                        <th scope="col">Produto</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Preço</th>
                        <th scope="col">Quantidade</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($produtos_mais_vendidos as $produto) { ?>
                        <tr class="text-center">
                            <td><img src="../images/<?= $produto['imagem'] ?>" width="50px" height="50px"></td>
                            <td><?= $produto['nome'] ?></td>
                            <td><?= $produto['preco'] ?></td>
                            <td><?= $produto['quantidade'] ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>



    <?php include_once("../includes/bootstrap_include.php"); ?>
</body>

</html>