<?php
    require_once __DIR__ . '/../vendor/autoload.php';
    use App\Enderecos;
    use App\Pedidos;
    use App\Pedidos_Itens;
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['usuario'])) {
    header('Location: logar.php');
    exit;
}

$enderecos = new Enderecos();
$idUsuario = $_SESSION['usuario']['id'];
$enderecos_listar = $enderecos->ListarPorID($idUsuario);


$itensCarrinho = [];
$total = 0;
$total_promocional = 0;

if (isset($_SESSION['usuario'])) {
    $pedido = new Pedidos();
    $pedido->id_usuarios_fk = $_SESSION['usuario']['id'];
    $pedidoAberto = $pedido->BuscarPedidosAbertos();

    if (!empty($pedidoAberto)) {
        $pedidoItens = new Pedidos_Itens();
        $pedidoItens->id_pedidos_fk = $pedidoAberto[0]['id'];
        $itensCarrinho = $pedidoItens->ListarPorPedido();

        foreach ($itensCarrinho as $item) {
            $total_promocional += $item['total'] ;
            $total += $item['quantidade'] * $item['preco'];
        }
    }
}

?>
    <title>Finalizar Pedido</title>

    <link rel="stylesheet" href="css/finalizar_pedido.css">
    <script src="js/finalizar_pedido.js" defer></script>
<div class="finalizar_pedido">
    <div class="header-backgroud"></div>
    <div class="container bg-light p-5 rounded-3 mb-5 shadow-lg w-100">
        <h2 class="titulo"><i class="bi bi-bag-check-fill"></i> Finalizar Pedido</h2>

        <div class="row">
            <!-- itens do pedido -->
            <div class="col-lg-7 col-md-8">
                <h5>Itens do carrinho</h5>

                <hr>

                <?php if (empty($itensCarrinho)) { ?>
                    <p class="text-muted text-center py-4">Seu carrinho está vazio.</p>
                <?php } else { ?>
                    <div class="row fw-bold border-bottom pb-2 mb-2">
                        <div class="col-5">Item</div>
                        <div class="col-2 text-center">Qtd</div>
                        <div class="col-2 text-end">Preço</div>
                        <div class="col-3 text-end">Total</div>
                    </div>

                    <?php foreach ($itensCarrinho as $item) { ?>
                        <div class="row align-items-center border-bottom py-3">

                            <div class="col-5">
                                <strong class="d-block text-truncate"><?= $item['nome'] ?></strong>
                            </div>

                            <div class="col-2 text-center">
                                <span class="badge bg-light text-dark border"><?= $item['quantidade'] ?>x</span>
                            </div>

                            <div class="col-2 d-flex align-items-center justify-content-end text-end text-muted" style="font-size: 0.9rem;">
                                <?php if ($item['preco_promocional'] > 0): ?>
                               <span class="text-decoration-line-through"> <?= number_format($item['preco'], 2, ',', '.') ?></span> - <?= number_format($item['preco_promocional'], 2, ',', '.') ?>
                                <?php else: ?>
                                    <?= number_format($item['preco'], 2, ',', '.') ?>
                                <?php endif; ?>
                            </div>

                            <div class="col-3 text-end fw-bold text-success">
                                R$ <?= number_format($item['total'], 2, ',', '.') ?>
                            </div>

                        </div>
                    <?php } ?>

                    <div class="resumo">
                        <span>Total:</span>
                        <strong>
                            <?php if ($total_promocional > 0): ?>
                               <span class="text-decoration-line-through"> R$ <?= number_format($total, 2, ',', '.') ?></span> - <span class="text-danger">R$ <?= number_format($total_promocional, 2, ',', '.') ?></span>
                            <?php else: ?>
                                R$ <?= number_format($total, 2, ',', '.') ?>
                            <?php endif; ?>
                    </strong>
                    </div>
                <?php } ?>
            </div>

            <!-- ver endereços -->
            <div class="d-flex align-items-center justify-content-center vr-style" style="width: 100px; height: 500px;">
                <div class="vr"></div>
            </div>
            <div class="col entregas">
                <h5>Rota de entrega</h5>
                <hr>

                <h4 class="mb-3"><i class="bi bi-geo-fill"></i> Endereço de entrega</h4>
                <form action="actions/pedidos/finalizar_pedido.php" method="POST">
                    <input type="hidden" name="id_pedido" value="<?= $pedidoAberto[0]['id'] ?>">
                    <div class="container-fluid">
                        <?php if (empty($enderecos_listar)) { ?>
                            <p class="text-muted">Você ainda não tem endereços cadastrados.</p>
                        <?php } else { ?>

                            <div class="list-group">
                                <?php foreach ($enderecos_listar as $e) { ?>
                                    <label class="list-group-item d-flex align-items-start gap-3">
                                        <input
                                            class="form-check-input mt-1"
                                            type="radio"
                                            name="id_endereco"
                                            value="<?= $e['id'] ?>"
                                            checked="checked"
                                            required>

                                        <div>
                                            <strong><?= $e['rua'] ?>, <?= $e['numero'] ?></strong><br>
                                            <?= $e['bairro'] ?> — <?= $e['cidade'] ?>/<?= $e['estado'] ?><br>
                                            <small class="text-muted">CEP: <?= $e['cep'] ?></small>
                                        </div>
                                    </label>
                                <?php } ?>
                            </div>

                        <?php } ?>

                        <a class="btn btn-warning mt-3 text-white" href="/enderecos"><i class="bi bi-plus-lg"></i> Adicionar novo endereço</a>

                    </div>

                    <!-- observações -->
                    <div class="mt-4">
                        <label class="form-label">Observações</label>
                        <textarea name="observacoes" class="form-control" rows="4"
                            placeholder="Ex: sem cebola, entregar na portaria..."></textarea>
                    </div>

                    <button id="btnFinalizar" disabled type="submit" class="btn btn-success w-100 btn-lg mt-3">
                        <div class="spinner-border" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>