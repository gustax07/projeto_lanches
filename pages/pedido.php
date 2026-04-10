<?php

require_once('classes/itens.class.php');
$item = new Itens;
$id = $_GET['id-produto'];
$item->id = $id;

$item_descricao = $item->ListarPorID()[0];

?>
<title><?= $item_descricao['nome'] ?></title>


<div class="pedido">
    <div class="header-backgroud"></div>
    <div class="container-fluid mb-5">
        <div class="row">
            <div class="d-flex justify-content-center col-md-6 col-sm-12 mb-3">
                <div class="img-destaque">
                    <img src="images/<?= $item_descricao['imagem']; ?>">

                    <div class="img-overlay">
                        <span class="badge-img">🔥 Destaque</span>
                    </div>
                </div>
            </div>


            <div class="d-flex flex-column col-md-3 col-sm-5 mt-3">
                <h1 class="fs-1 fw-bold"><?= $item_descricao['nome'] ?></h1>
                <p class="text-muted">By Tasty Burgers</p>
                <h1 class="fs-1 fw-bold">R$<?= $item_descricao['preco'] ?></h1>
                

                    <form action="actions/pedido_itens/cadastrar_pedido_itens.php" method="post">
                        <input type="hidden" name="id_item" value="<?= $id ?>" readonly>
                        <input type="number" name="quantidade" value="1" min="1" max="99" class="form-control text-center" style="width: 80px;">
                        <div class="d-flex align-items-center gap-2 w-100 mt-3">
                            <button type="submit" class="btn btn-warning"><i class="bi bi-cart-plus"></i> Adicionar ao carrinho</button>
                            <!-- <button type="button" class="btn btn-warning"><i class="bi bi-cart-check"></i>Comprar agora</button> -->
                        </div>
                    </form>
                
                <hr>
                <strong>Descrição:</strong>
                <p><?= $item_descricao['descricao'] ?></p>

            </div>
        </div>
    </div>
 
</div>