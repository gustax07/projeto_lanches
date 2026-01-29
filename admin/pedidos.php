<?php

include_once('../classes/pedidos.class.php');
$pedidos = new Pedidos();
$pedidos_listar = $pedidos->ListarInnerJoin();
$idPedidoModal = 0;
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
        <?php foreach ($pedidos_listar as $p) {  ?>
            <tr>
                <td><?= $p['id'] ?></td>
                <td><?= $p['nome'] ?></td>
                <td><?= $p['status'] ?></td>
                <td><?= $p['data_pedido'] ?></td>
                <td><?= $p['observacoes'] ?></td>
                <td>
                    <a href="../actions/pedidos/cancelar_pedidos.php?id=<?= $p['id'] ?>" class="btn btn-danger">Cancelar</a>
                    <a href="../actions/pedidos/preparar_pedidos.php?id=<?= $p['id'] ?>" class="btn btn-primary">Preprarar</a>
                    <!-- <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#visualizarPedido"> -->
                      <!-- Visualizar -->
                      <!-- Enviar o id do pedido para modal -->
                      <a type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#visualizarPedido" data-bs-valor="<?= $p['id'] ?>" onclick="document.getElementById('idPedidoModal').value = <?= $p['id'] ?>;">
                      Visualizar
                      </a>

                    <!-- </button> -->
                    <a href="gerar_pdf.php?id=<?= $p['id'] ?>" class="btn btn-success">Finalizar Pedido</a>
                </td>
            </tr>
        <?php } ?>
    </table>
    </div>

            <script>
            function submitForm() {
            var minhaVar = $('#visualizarPedido').data('var');
            $('#minha-var').val(minhaVar);
            $('#meu-form').submit();
            }
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
        <form>
         <!-- detalhes do pedido -->
          
          <?php
            include_once('../classes/pedidos_itens.class.php');
            $pedido_itens = new Pedido_Itens();
            $pedido_itens->id_pedidos_fk = ;
            $pedido_detalhes = $pedido_itens->ListarPedidoInnerJoinComID();
            foreach ($pedido_detalhes as $pd) {?>
            <p><strong>ID do Pedido:</strong> <?= $pd['id'] ?></p>
            <p><strong>Pedido:</strong> <?= $pd['Pedido'] ?></p>
            <p><strong>Quantidade:</strong> <?= $pd['quantidade'] ?></p>
            <p><strong>Descrição:</strong> <?= $pd['descricao'] ?></p>
            <p><strong>Observações:</strong> <?= $pd['observacoes'] ?></p>
            <p><strong>Status:</strong> <?= $pd['status'] ?></p>
            <p><strong>Data do Pedido:</strong> <?= $pd['data_pedido'] ?></p>
          <?php } ?>
            <!-- fim dos detalhes do pedido -->
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>
    
    <!-- bootstrap include e sweet alert2 include -->
    <?php include_once('.././includes/bootstrap_include.php'); ?>
    <?php include_once('.././includes/sweet_alert2_include.php'); ?>
</body>

</html>