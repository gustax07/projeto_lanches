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
$pedidos_status = $pedidos_itens->StatusFinanceiro();
$status_dos_pedidos = $pedidos_itens->StatusPedidos();
$horarios_de_picos = $pedidos_itens->HorariosDePicos();

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
    <link rel="stylesheet" href="<?php echo $base_path; ?>admin/css/index.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>

    <!-- card de apresentacao do dashboard  -->



    <div class="container-fluid flex-nowrap flex-wrap mt-5">
        <div class="row justify-content-start">
            <?php
            criarCard('Pedidos', $quantidade_pedidos, $meta_pedidos, "#4099ff,#73b4ff", "#2e8bd8ff", '<i class="bi bi-bag-check-fill"></i>', $base_path . 'admin/pedidos.php');
            criarCard('Funcionarios', $quantidade_funcionarios, 100, "#2ed8b6,#59e0c5", "#4caf81ff", '<i class="bi bi-people-fill"></i>', $base_path . 'admin/gerenciar_funcionarios.php');
            criarCard('Clientes', $quantidade_clientes, 100, '#FF5370,#ff869a', "#ff869aff", '<i class="bi bi-people-fill"></i>', $base_path . 'admin/clientes.php');
            criarCard('Categorias', $quantidade_categorias, 100, '#FFB64D,#ffcb80', "#ffcb80ff", '<i class="bi bi-tags-fill"></i>', $base_path . 'admin/categorias.php');
            criarCard('Cargos', $quantidade_tipos, 100, "#c850c0,#dd6fd6", "#dd6fd6ff", '<i class="bi bi-tags-fill"></i>', $base_path . 'admin/tipos.php');
            criarCard('Produtos', $quantidade_itens, 100, "#4CAF50,#8BC34A", "#3dbb41ff", '<i class="bi bi-basket-fill"></i>', $base_path . 'admin/produtos.php');
            criarCard('Enderecos', $quantidade_enderecos, 100, "#FFB64D,#ffcb80", "#ffcb80ff", '<i class="bi bi-geo-alt-fill"></i>', $base_path . 'admin/enderecos.php');
            criarCard('Telefones', $quantidade_telefones, 100, "#4099ff,#73b4ff", "#2e8bd8ff", '<i class="bi bi-telephone-fill"></i>', $base_path . 'admin/telefones.php');
            ?>
        </div>
    </div>
    <hr class="container col-7">
    <h1 class="text-center">Estatisticas em tempo real</h1>
    <!-- lista o produtos mais vendidos -->
    <div class="container-fluid">
        <div class="row gap-4 justify-content-center flex-wrap">
            <div class="col-md-6 col-sm-8 col-lg-5 card shadow-sm border-0 p-3 mt-4">
                <table class="table table-responsive">
                    <h4><i class="bi bi-graph-up-arrow me-2"></i> Produtos Mais Vendidos</h4>
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
            <?php
            $datas = [];
            $faturamento = [];
            $status_pedido = [];
            $total_status = [];
            $horario = [];
            $tota_horario = [];

            foreach ($pedidos_status as $status) {
                $datas[] = $status['dia'];
                $faturamento[] = $status['faturamento'];
            }
            foreach ($status_dos_pedidos as $status) {
                $status_pedido[] = $status['status'];
                $total_status[] = $status['total'];
            }

            foreach ($horarios_de_picos as $horarios) {
                $horario[] = $horarios['hora'] . ':00';
                $tota_horario[] = $horarios['total'];
            }
            ?>

            <div class="col-md-5 col-sm-9 col-lg-6 card shadow-sm border-0 p-3 mt-4">
                <h4><i class="bi bi-graph-up-arrow me-2"></i> Status dos Pedidos</h4>
                <?php if (count($status_pedido) == 0) {

                    echo "<div class='d-flex align-items-center justify-content-center mt-5'>
        <h3 class='text-danger'><i class='bi bi-exclamation-triangle-fill'></i> Dados Insuficientes</h3>
        </div>";
                } else { ?>
                    <canvas id="graficoPedidos" style="height:100"></canvas>
                    <script>
                        const ctxPedidos = document.getElementById('graficoPedidos').getContext('2d');
                        new Chart(ctxPedidos, {
                            type: 'pie',
                            data: {
                                labels: <?= json_encode($status_pedido) ?>,
                                datasets: [{
                                    label: 'Pedidos',
                                    data: <?= json_encode($total_status) ?>,
                                    backgroundColor: [
                                        '#ff6384',
                                        '#36a2eb',
                                        '#ffce56',
                                        '#4bc0c0',
                                        '#9966ff'
                                    ],
                                    borderWidth: 1
                                }]
                            },
                        });
                    </script>
                <?php } ?>
            </div>
        </div>
        <div class="row gap-4 justify-content-center flex-wrap">
            <div class="col-md-5 col-sm-8 col-lg-5 card shadow-sm border-0 p-3 mt-4">
                <h4><i class="bi bi-graph-up-arrow me-2"></i> Horario de Picos</h4>
                <canvas id="graficoHorario" style="height:100"></canvas>
                <script>
                    const ctxHorario = document.getElementById('graficoHorario').getContext('2d');
                    new Chart(ctxHorario, {
                        type: 'bar',
                        data: {
                            labels: <?= json_encode($horario) ?>,
                            datasets: [{
                                label: 'Pedidos',
                                data: <?= json_encode($tota_horario) ?>,
                                backgroundColor: [
                                    'rgba(255, 99, 132, 0.2)',
                                    'rgba(255, 159, 64, 0.2)',
                                    'rgba(255, 205, 86, 0.2)',
                                    'rgba(75, 192, 192, 0.2)',
                                    'rgba(54, 162, 235, 0.2)',
                                    'rgba(153, 102, 255, 0.2)',
                                    'rgba(201, 203, 207, 0.2)'
                                ],
                                borderColor: [
                                    'rgb(255, 99, 132)',
                                    'rgb(255, 159, 64)',
                                    'rgb(255, 205, 86)',
                                    'rgb(75, 192, 192)',
                                    'rgb(54, 162, 235)',
                                    'rgb(153, 102, 255)',
                                    'rgb(201, 203, 207)'
                                ],
                                borderWidth: 1
                            }]
                        },
                    });
                </script>
            </div>
            <div class="col-md-5 col-sm-9 col-lg-6 card shadow-sm border-0 p-3 mt-4">
                <h4><i class="bi bi-graph-up-arrow me-2"></i> Faturamento dos Últimos 7 Dias</h4>

                <canvas id="graficoVendas" style="height:100"></canvas>
                <script>
                    const ctx = document.getElementById('graficoVendas').getContext('2d');
                    new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: <?= json_encode($datas) ?>,
                            datasets: [{
                                label: 'R$ Faturamento',
                                data: <?= json_encode($faturamento) ?>,
                                borderColor: '#ffc107',
                                backgroundColor: 'rgba(255, 193, 7, 0.2)',
                                fill: true,
                                tension: 0.4
                            }]
                        },
                    });
                </script>
            </div>
        </div>
    </div>




    <?php include_once("../includes/bootstrap_include.php"); ?>
</body>

</html>