<?php

include_once('../classes/pedidos.class.php');
$pedidos = new Pedidos();
$pedidos_listar = $pedidos->ListarInnerJoin();

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Pedidos</title>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <h1 class="text-center mt-3 mb-5">Gerenciar Pedidos</h1>
    <div class="container">
        <table class="table table-bordered table-striped">
            <tr class="table-dark col-auto">
                <th>ID</th>
                <th>Cliente</th>
                <th>Status</th>
                <th>Data do Pedido</th>
                <th>Observação</th>
                <th>Ações</th>
            </tr>
            <?php foreach ($pedidos_listar as $p) {  ?>
                <tr>
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
                            Detalhes do Pedido
                        </button>
                    </td>
                </tr>
            <?php } ?>
        </table>

    </div>


    <script>
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
                <div class="modal-footer">
                    <?php 
                    $pedidos_listar_status = $pedidos->ListarStatusComID(); ?>
                    <?php foreach ($pedidos_listar_status as $p) { ?>
                        <?php if ($p['status'] == 'preparando') { ?>
                            <a href="../actions/pedidos/finalizar_pedidos.php?id=<?= $p['id'] ?>" class="btn btn-success btn-sm">Concluir Pedido</a>
                        <?php } else { ?>
                            <a href="../actions/pedidos/preparar_pedidos.php?id=<?= $p['id'] ?>" class="btn btn-primary btn-sm">Comecar a Preparar</a>
                        <?php } ?>
                        <!-- <a href="../actions/pedidos/cancelar_pedidos.php?id=<?= $p['id'] ?>" class="btn btn-danger btn-sm">Cancelar</a>
                    <a href="../actions/pedidos/preparar_pedidos.php?id=<?= $p['id'] ?>" class="btn btn-primary btn-sm">Preprarar</a>
                    <a href="../actions/pedido_itens/finalizar_pedidos.php?id=<?= $p['id'] ?>" class="btn btn-success btn-sm">Finalizar Pedido</a> -->
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

    <!-- bootstrap include e sweet alert2 include -->
    <?php include_once('.././includes/bootstrap_include.php'); ?>
    <?php include_once('.././includes/sweet_alert2_include.php'); ?>
</body>

</html>