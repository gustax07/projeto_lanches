<?php include('includes/bootstrap_include.php');?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/meus_pedidos.css">
    <title>Meus pedidos</title>
</head>

<body>
    <?php include('./header.php'); ?>
    <div class="container-fluid mt-4 pedidos-container">
  <div class="row">

    <div class="col-md-4 border-end lista-pedidos">
      <h5 class="fw-bold mb-3">Meus pedidos</h5>

      <div class="list-group">
        <a href="?pedido=123" class="list-group-item list-group-item-action active">
          <strong>Pedido #123</strong><br>
          <small>Status: Em preparo</small>
        </a>

        <a href="?pedido=122" class="list-group-item list-group-item-action">
          <strong>Pedido #122</strong><br>
          <small>Status: Entregue</small>
        </a>
      </div>
    </div>

    <div class="col-md-8 detalhes-pedido">
      <h4 class="fw-bold">Pedido #123</h4>
      <p>Status atual: <strong>Em preparo</strong></p>

      <ul class="list-group list-group-horizontal-md text-center">
        <li class="list-group-item flex-fill progresso-ok">Pedido</li>
        <li class="list-group-item flex-fill progresso-ok">Pago</li>
        <li class="list-group-item flex-fill progresso-atual">Em preparo</li>
        <li class="list-group-item flex-fill progresso-pendente">Entrega</li>
        <li class="list-group-item flex-fill progresso-pendente">Entregue</li>
      </ul>
    </div>

  </div>
</div>
<?php include('./footer.html'); ?>
</body>
</html>