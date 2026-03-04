<?php
require_once('../classes/dashboard.class.php');
$dashboard = new Dashboard();
$dashboard_listar = $dashboard->ListarTodos()[0];
require_once('../classes/pedidos_itens.class.php');
$pedidos_itens = new Pedido_Itens();
$produtos_mais_vendidos = $pedidos_itens->listarTop5Vendidos();
$pedidos_status = $pedidos_itens->StatusFinanceiro();
$status_dos_pedidos = $pedidos_itens->StatusPedidos();
$horarios_de_picos = $pedidos_itens->HorariosDePicos();

// Se estiver no localhost, a raiz é a pasta do projeto. No servidor, é a pasta admin.
$base_path = ($_SERVER['HTTP_HOST'] == 'localhost') ? '/projeto_lanches/admin/' : '/admin/';

include('./header.php');
$meta_pedidos = 200;

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
        <p class="m-b-0 fs-6">Progresso do Mes</p>
        <span class="m-l-5">' . $quantidade / $meta * 100 . '%</span>
        </div>
        <div class="progress" role="progressbar" aria-valuenow="' . $quantidade / $meta * 100 . '" aria-valuemin="0" aria-valuemax="100">
           <div class="progress-bar progress-bar-animated" style="width: ' . $quantidade / $meta * 100 . '%; background-color:' . $cor . '"></div>
        </div>
    </div>
</div>
</a>
</div>';

}?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela Inicial</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="<?= $base_path ?>../css/index_admin.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src= "<?= $base_path ?>../js/index.js"></script>
</head>

<body>

    <div class="container-fluid flex-nowrap flex-wrap mt-5">
        <div class="row justify-content-start">
            <?php
            criarCard('Pedidos', $dashboard_listar['total_pedidos'], $meta_pedidos, "#4099ff,#73b4ff", "#2e8bd8ff", '<i class="bi bi-bag-check-fill"></i>', $base_path . 'pedidos.php');
            criarCard('Funcionarios', $dashboard_listar['total_funcionarios'], 100, "#2ed8b6,#59e0c5", "#4caf81ff", '<i class="bi bi-people-fill"></i>', $base_path . 'gerenciar_funcionarios.php');
            criarCard('Clientes', $dashboard_listar['total_clientes'], 100, '#FF5370,#ff869a', "#ff869aff", '<i class="bi bi-people-fill"></i>', $base_path . 'clientes.php');
            criarCard('Categorias', $dashboard_listar['total_categorias'], 100, '#FFB64D,#ffcb80', "#ffcb80ff", '<i class="bi bi-tags-fill"></i>', $base_path . 'gerenciar_categorias.php');
            criarCard('Cargos', $dashboard_listar['total_cargos'], 100, "#c850c0,#dd6fd6", "#dd6fd6ff", '<i class="bi bi-tags-fill"></i>', $base_path . 'tipos.php');
            criarCard('Produtos', $dashboard_listar['total_produtos'], 100, "#4CAF50,#8BC34A", "#3dbb41ff", '<i class="bi bi-basket-fill"></i>', $base_path . 'gerenciar_produtos.php');
            criarCard('Enderecos', $dashboard_listar['total_enderecos'], 100, "#FFB64D,#ffcb80", "#ffcb80ff", '<i class="bi bi-geo-alt-fill"></i>', $base_path . 'enderecos.php');
            criarCard('Telefones', $dashboard_listar['total_telefones'], 100, "#4099ff,#73b4ff", "#2e8bd8ff", '<i class="bi bi-telephone-fill"></i>', $base_path . 'telefones.php');
            ?>
        </div>
    </div>
    <hr class="container col-7">
    <h1 class="text-center">Estatisticas em tempo real</h1>

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
                                <td><img src="<?php echo $base_path; ?>../images/<?= $produto['imagem'] ?>" width="50px" height="50px"></td>
                                <td><?= $produto['nome'] ?></td>
                                <td><?= $produto['preco'] ?></td>
                                <td><?= $produto['quantidade'] ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <div class="col-md-5 col-sm-9 col-lg-3 card shadow-sm border-0 p-3 mt-4">
                <h4><i class="bi bi-graph-up-arrow me-2"></i> Status dos Pedidos</h4>
                <?php if (count($status_pedido) == 0) {

                    echo "<div class='d-flex align-items-center justify-content-center mt-5'>
                            <h3 class='text-danger'><i class='bi bi-exclamation-triangle-fill'></i> Dados Insuficientes</h3>
                        </div>";
                } else { ?>
                    <canvas id="graficoPedidos"></canvas>

                    <script>
                        const JSlabelPedidos = <?= json_encode($status_pedido) ?>;
                        const JSdataPedidos = <?= json_encode($total_status) ?>;

                        graficoPedidos(JSlabelPedidos, JSdataPedidos);
                    </script>
                <?php } ?>
            </div>
        </div>
        <div class="row gap-4 justify-content-center flex-wrap">
            <div class="col-md-5 col-sm-8 col-lg-5 card shadow-sm border-0 p-3 mt-4">
                <h4><i class="bi bi-graph-up-arrow me-2"></i> Horario de Picos</h4>
                <?php if (count($horario) == 0) {
                    echo "<div class='d-flex align-items-center justify-content-center mt-5'>
                            <h3 class='text-danger'><i class='bi bi-exclamation-triangle-fill'></i> Dados Insuficientes</h3>
                        </div>";
                } else { ?>
                    <canvas id="graficoHorario" style="height:100"></canvas>
                    <script>
                        const JSlabelHorario = <?= json_encode($horario) ?>;
                        const JSdataHorario = <?= json_encode($tota_horario) ?>;

                        graficoHorarios(JSlabelHorario, JSdataHorario);
                    </script>
                <?php } ?>
            </div>
            <div class="col-md-5 col-sm-9 col-lg-6 card shadow-sm border-0 p-3 mt-4">
                <h4><i class="bi bi-graph-up-arrow me-2"></i> Faturamento dos Últimos 7 Dias</h4>
                <?php if (count($datas) == 0) {
                    echo "<div class='d-flex align-items-center justify-content-center mt-5'>
                            <h3 class='text-danger'><i class='bi bi-exclamation-triangle-fill'></i> Dados Insuficientes</h3>
                        </div>";
                } else { ?>
                    <canvas id="graficoVendas" style="height:100"></canvas>
                    <script>
                        const JSlabelVendas = <?= json_encode($datas) ?>;
                        const JSdataVendas = <?= json_encode($faturamento) ?>;

                        graficoFinanceiro(JSlabelVendas, JSdataVendas);
                    </script>
                <?php } ?>
            </div>
        </div>
    </div>
</body>

</html>