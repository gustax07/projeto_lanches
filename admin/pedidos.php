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
    <title>Document</title>
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
        <?php foreach ($pedidos_listar as $p) { ?>
            <tr>
                <td><?= $p['id'] ?></td>
                <td><?= $p['nome'] ?></td>
                <td><?= $p['status'] ?></td>
                <td><?= $p['data_pedido'] ?></td>
                <td><?= $p['observacoes'] ?></td>
                <td>
                    <a href="excluir_pedido.php?id=<?= $p['id'] ?>" class="btn btn-danger">Cancelar</a>
                    <a href="editar_pedido.php?id=<?= $p['id'] ?>" class="btn btn-primary">Preprarar</a>
                    <a href="visualizar_pedido.php?id=<?= $p['id'] ?>" class="btn btn-info text-white">Visualizar</a>
                    <a href="gerar_pdf.php?id=<?= $p['id'] ?>" class="btn btn-success">Finalizar Pedido</a>
                </td>
            </tr>
        <?php } ?>
    </table>
    </div>

    <?php include_once('.././includes/bootstrap_include.php'); ?>
</body>

</html>