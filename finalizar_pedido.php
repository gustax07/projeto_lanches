<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once('./classes/pedidos.class.php');
require_once('./classes/pedidos_itens.class.php');

require_once('./classes/enderecos.class.php');
$enderecos = new Enderecos();
$idUsuario = $_SESSION['usuario']['id'];
$enderecos_listar = $enderecos->ListarPorID($idUsuario);


$itensCarrinho = [];
$total = 0;

if (isset($_SESSION['usuario'])) {
    $pedido = new Pedidos();
    $pedido->id_usuarios_fk = $_SESSION['usuario']['id'];
    $pedidoAberto = $pedido->BuscarPedidosAbertos();

    if (!empty($pedidoAberto)) {
        $pedidoItens = new Pedido_Itens();
        $pedidoItens->id_pedidos_fk = $pedidoAberto[0]['id'];
        $itensCarrinho = $pedidoItens->ListarPorPedido();

        foreach ($itensCarrinho as $item) {
            $total += $item['preco'] * $item['quantidade'];
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Finalizar Pedido</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            padding-top: 250px;
        }

        body {
            background: #f7f7f7;
        }

        .checkout-container {
            max-width: 1200px;
            margin: 40px auto;
            background: #fff;
            padding: 30px;
            border-radius: 12px;
        }

        .titulo {
            font-weight: 600;
            margin-bottom: 30px;
        }

        .lista-item {
            display: grid;
            grid-template-columns: 1fr auto auto;
            gap: 15px;
            padding: 12px 0;
            border-bottom: 1px solid #eee;
        }

        .lista-item:last-child {
            border-bottom: none;
        }

        .preco {
            font-weight: 600;
        }

        .resumo {
            border-top: 2px solid #000;
            margin-top: 20px;
            padding-top: 15px;
            font-size: 18px;
            display: flex;
            justify-content: space-between;
        }

        textarea {
            resize: none;
        }

        @media (max-width: 768px) {
            .checkout-container {
                padding: 20px;
            }
        }
    </style>
</head>

<body>

    <div class="checkout-container">
        <h2 class="titulo">🧾 Finalizar Pedido</h2>

        <div class="row g-4">
            <!-- itens do pedido -->
            <div class="col-md-7">
                <h5>Itens do pedido</h5>

                <?php if (empty($itensCarrinho)) { ?>
                    <p class="text-muted">Seu carrinho está vazio.</p>
                <?php } else { ?>
                    <?php foreach ($itensCarrinho as $item) { ?>
                        <div class="lista-item">
                            <div>
                                <strong><?= $item['nome'] ?></strong><br>
                                <small>Qtd: <?= $item['quantidade'] ?></small>
                            </div>

                            <div>
                                R$ <?= number_format($item['preco'], 2, ',', '.') ?>
                            </div>

                            <div class="preco">
                                R$ <?= number_format($item['preco'] * $item['quantidade'], 2, ',', '.') ?>
                            </div>
                        </div>
                    <?php } ?>

                    <div class="resumo">
                        <span>Total</span>
                        <strong>R$ <?= number_format($total, 2, ',', '.') ?></strong>
                    </div>
                <?php } ?>
            </div>

            <!-- ver endereços -->
            <div class="col-md-5">
                <h5>Entrega</h5>

                <form action="actions/pedidos/finalizar.php" method="POST">

                    <div class="checkout-container">

                        <h4 class="mb-3">📍 Endereço de entrega</h4>

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

                        <a
                            class="btn btn-outline-warning mt-3"
                            data-bs-toggle="modal"
                            data-bs-target="#modalEndereco"
                            href="enderecos.php">
                            ➕ Cadastrar novo endereço
                                </a>

                    </div>


                    <!-- observações -->
                    <div class="mb-3">
                        <label class="form-label">Observações</label>
                        <textarea name="observacoes" class="form-control" rows="4"
                            placeholder="Ex: sem cebola, entregar na portaria..."></textarea>
                    </div>

                    <button type="submit" class="btn btn-success w-100 btn-lg">
                        Confirmar Pedido
                    </button>
                </form>
            </div>
        </div>
    </div>

</body>

</html>