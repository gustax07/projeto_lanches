<?php
session_start();
include('header.php');
require_once('classes/pedidos.class.php');

if (!isset($_SESSION['usuario'])) {
  header("Location: logar.php");
  exit;
}

$pedidos = new Pedidos();
$pedidos->id_usuarios_fk = $_SESSION['usuario']['id'];

$listaPedidos = $pedidos->BuscarPedidosPeloIDUsuario();

$pedidoSelecionado = $_GET['pedido'] ?? $listaPedidos[0]['id'] ?? null;

$detalhePedido = null;

foreach ($listaPedidos as $p) {
  if ($p['id'] == $pedidoSelecionado) {
    $detalhePedido = $p;
    break;
  }
}

$statusPedido = $detalhePedido['status'];

$etapaAtual = match ($statusPedido) {
  'pendente' => 1,
  'preparando' => 2,
  'saiu para entrega' => 3,
  'entregue' => 4,
  'concluido' => 5,
  default => 1
};

?>
<link rel="stylesheet" href="css/meus_pedidos.css">
<title>Meus Pedidos</title>

<div class="meus_pedidos">
  <div class="header-backgroud"></div>
  <div class="container pedidos-container">
    <div class="row">
      <div class="col-md-4 lista-pedidos">
        <h5 class="fw-bold mb-3">Meus pedidos</h5>
        <div class="list-group">
          <?php foreach ($listaPedidos as $pedido):

            $status = $pedido['status'];
            $statusCor = match ($status) {
              'pendente' => 'secondary',
              'preparando' => 'primary',
              'saiu para entrega' => 'warning',
              'entregue' => 'info',
              'concluido' => 'success',
              default => 'dark'
            };

          ?>

            <a href="?pedido=<?= $pedido['id'] ?>"
              class="list-group-item list-group-item-action <?= $pedidoSelecionado == $pedido['id'] ? 'active' : '' ?>">
              <div class="d-flex justify-content-between align-items-center">
                <div>
                  <strong>Pedido #<?= $pedido['id'] ?></strong><br>
                  <small class="text-muted">
                    <?= isset($pedido['data']) ? date('d/m/Y H:i', strtotime($pedido['data'])) : '' ?>
                  </small>
                </div>
                <span class="badge bg-<?= $statusCor ?>">
                  <?= ucfirst(str_replace('_', ' ', $status)) ?>
                </span>
              </div>
            </a>
          <?php endforeach; ?>
        </div>
      </div>

      <div class="col-md-8 detalhes-pedido">
        <?php if ($detalhePedido): ?>
          <h4 class="fw-bold">Pedido #<?= $detalhePedido['id'] ?></h4>
          <p class="status-atual">
            Status atual:
            <strong><?= ucfirst(str_replace('_', ' ', $detalhePedido['status'])) ?></strong>
          </p>
          <div class="progresso-container">
            <div class="progresso-linha"></div>

            <?php
            $etapas = [
              1 => "Pendente",
              2 => "preparando",
              3 => "saiu para entrega",
              4 => "entregue",
              5 => "concluido"
            ];

            foreach ($etapas as $numero => $nome) {

              if ($numero < $etapaAtual) {
                $classe = "ok";
              } elseif ($numero == $etapaAtual) {
                $classe = "atual";
              } else {
                $classe = "pendente";
              }

            ?>
              <div class="progresso-etapa <?= $classe ?>">
                <div class="bolinha"></div>
                <span><?= $nome ?></span>
              </div>

            <?php } ?>
          </div>
        <?php else: ?>
          <p>Nenhum pedido encontrado.</p>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>