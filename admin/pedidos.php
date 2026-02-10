<?php

include_once('../classes/pedidos.class.php');
$pedidos = new Pedidos();
$pedidos_listar = $pedidos->ListarInnerJoin();
$pedidos->nome = $_GET['pesquisar'] ?? '';
$pedidos_listar_pelo_nome = $pedidos->ListarPedidosPeloNomeCliente();
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Pedidos</title>
    <style>
        .btn {
            cursor: pointer;
            transition: transform 0.2s ease !important;
        }

        .btn:hover {
            transform: scale(1.1);
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <h1 class=" shadow-lg p-3 bg-body-tertiary text-center mt-3 mb-5">Gerenciar Pedidos</h1>
    <div class="container">
        <div class="row mb-3">
            <div class="col-md-6">
                <form action="../actions/pedidos/filtrar_pedidos.php" method="post" class="d-flex align-items-center gap-2">

                    <select name="status" id="status" class="form-select w-50">
                        <option value="todos">Todos</option>
                        <option value="pendente">Pendente</option>
                        <option value="preparando">Preparando</option>
                        <option value="entregue">Entregue</option>
                        <option value="concluido">Concluido</option>
                    </select>

                    <button type="submit" class="btn btn-primary" id="filtrar">Filtrar</button>
                </form>
            </div>

            <div class="col-md-6 d-flex justify-content-end">
                <form action="../actions/pedidos/pesquisar_pedidos.php" method="post" class="d-flex align-items-center gap-2 ">

                    <input type="text" id="pesquisar" name="pesquisar" value="<?= $_GET['pesquisar'] ?? '' ?>" class="form-control" placeholder="Digite o nome do cliente">

                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-search"></i>
                    </button>
                </form>
            </div>
        </div>

        <?php if (!empty($_GET['pesquisar'])) { ?>
            <?php if (count($pedidos_listar_pelo_nome) == 0) { ?>
                <div class="alert alert-danger" role="alert">
                    Nenhum pedido encontrado para o cliente <?= $_GET['pesquisar'] ?>
                </div>
                <div class="d-flex justify-content-center">
                    <button type="button" class="btn btn-primary" onclick="window.location.assign('pedidos.php')">Voltar para a página inicial</button>
                </div>
            <?php } else { ?>
                <table class="table table-bordered table-striped table-hover ">
                    <tr class="table-dark">
                        <th>ID</th>
                        <th>Cliente</th>
                        <th>Status</th>
                        <th>Data do Pedido</th>
                        <th>Observação</th>
                        <th>Ações</th>
                    </tr>
                    <?php foreach ($pedidos_listar_pelo_nome as $p) {  ?>
                        <tr>
                            <td><?= $p['id'] ?></td>
                            <td><?= $p['nome'] ?></td>
                            <td><?= $p['status'] ?></td>
                            <td><?= $p['data_pedido'] ?></td>
                            <td><?= $p['observacoes'] ?></td>
                            <td class="d-flex justify-content-center">
                                <!-- Enviar o id do pedido para modal -->
                                <button
                                    class="btn btn-info btn-sm text-white"
                                    data-bs-toggle="modal"
                                    data-bs-target="#visualizarPedido"
                                    data-id="<?= $p['id'] ?>">
                                    Detalhes
                                </button>
                                <button class="btn btn-danger btn-sm text-white" onclick="excluirPedido(<?= $p['id'] ?>)">Excluir</button>
                            </td>
                        </tr>
                    <?php } ?>
                <?php } ?>
                </table>
            <?php } else { ?>
                <table class="table table-bordered table-striped table-hover ">
                    <tr class="table-dark text-center">
                        <th>ID</th>
                        <th>Cliente</th>
                        <th>Status</th>
                        <th>Data do Pedido</th>
                        <th>Observação</th>
                        <th>Ações</th>
                    </tr>
                    <?php foreach ($pedidos_listar as $p) {  ?>
                        <tr class="text-center">
                            <td><?= $p['id'] ?></td>
                            <td><?= $p['nome'] ?></td>
                            <td><?= $p['status'] ?></td>
                            <td><?= $p['data_pedido'] ?></td>
                            <td><?= $p['observacoes'] ?></td>
                            <td>
                                <!-- Enviar o id do pedido para modal -->
                                <button
                                    class="btn btn-info btn-sm text-white"
                                    data-bs-toggle="modal"
                                    data-bs-target="#visualizarPedido"
                                    data-id="<?= $p['id'] ?>">
                                    Detalhes
                                </button>
                                <button class="btn btn-danger btn-sm text-white" onclick="excluirPedido(<?= $p['id'] ?>)">Excluir</button>
                            </td>
                        </tr>
                    <?php } ?>
                </table>
            <?php } ?>
    </div>


    <script>
        function excluirPedido(id) {
            Swal.fire({
                title: "Você tem certeza?",
                text: "Você não poderá reverter isso!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Sim, excluir!",
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "../actions/pedidos/remover_pedidos.php?id=" + id;
                }
            });
        }

        $(document).ready(function() {
            $('.btn-info').click(function() {
                var id = $(this).data('id');
                $('#m_id').text(id);
                // Fazer uma requisição AJAX para buscar os detalhes do pedido
                $ajaxRequest = $.ajax({
                    url: '../actions/pedido_itens/visualizar_itens.php',
                    type: 'GET',
                    data: {
                        id: id
                    },
                    success: function(response) {
                        // Preencher o modal com os detalhes do pedido
                        $('#modalBody').html(response);
                    }
                })

            });
        });
    </script>
    <!-- criar um modal do bootstrap para visualizar o pedido com mais detalhes -->
    <div class="modal fade" id="visualizarPedido" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Detalhes do Pedido</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="modalBody">

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- bootstrap include e sweet alert2 include -->
    <?php include_once('.././includes/bootstrap_include.php'); ?>
    <?php include_once('.././includes/sweet_alert2_include.php'); ?>
</body>

</html>