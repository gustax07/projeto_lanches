<?php
require_once __DIR__ . '/../vendor/autoload.php';
use App\Itens;

$item = new Itens;
$id = $_GET['id-produto'];
$item->id = $id;

$i = $item->ListarPorID()[0];

function Porcentagem($preco_original, $preco_promocional)
{
    if (empty($preco_promocional)){
        return;
    };

    $resultado = $preco_original - $preco_promocional;
    $porcentagem = ($resultado / $preco_original) * 100;
    return round($porcentagem, 0);
}
?>
<title><?= $i['nome'] ?></title>
<style>
    .pedido .alert-danger {
        font-size: 24px !important;
    }
</style>

<div class="pedido">
    <div class="header-backgroud"></div>
    <div class="container-fluid mb-5">
        <div class="row">
            <div class="d-flex justify-content-center col-md-6 col-sm-12 mb-3">
                <div class="img-destaque">
                    <img src="images/<?= $i['imagem']; ?>">

                    <div class="img-overlay">
                        <span class="badge-img">🔥 Destaque</span>
                    </div>
                </div>
            </div>
            <div class="d-flex flex-column col-md-4 col-sm-5 mt-3">
                <h1 id="nome" class="fw-bold"><?= $i['nome'] ?>
                <?php if (!empty($i['preco_promocional'])): ?>
                <span class="alert alert-danger ms-1" role="alert"> <i class="bi bi-tag"></i> <?= Porcentagem($i['preco'], $i['preco_promocional']) ?>%</span>
                <?php endif; ?>
            </h1>
            <p class="text-muted">By Tasty Burgers</p>
            
            <div class="produto-preco">
                    <?php if (!empty($i['preco_promocional'])): ?>  
                        <span id="preco" class="text-muted text-decoration-line-through" >R$<?= $i['preco'] ?></span>
                        <span class="text-muted">-</span>
                        <span id="preco_promocional" class="produto-preco">R$<?= $i['preco_promocional'] ?></span>
                    <?php else: ?>
                        <h1 id="preco" class="fs-1 fw-bold">R$<?= $i['preco'] ?></h1>
                    <?php endif; ?>
                </div>
                <hr>
                <label for="quantidade">Quantidade:</label>
                <div class="d-flex">
                    <button class="btn bi bi-dash-circle" onclick="SubQuantidade(<?= $i['preco'] ?>, <?= $i['preco_promocional'] ?>);" hidden></button>
                    <input type="text" id="quantidade" value="1" pattern="[0-9]*" class="form-control text-center" style="width: 80px;" onblur="verificarQuantidade(); CalcularTotal(<?= $i['preco'] ?>, <?= $i['preco_promocional'] ?>);">
                    <button class="btn bi bi-plus-circle" onclick="AddQuantidade(<?= $i['preco'] ?>, <?= $i['preco_promocional'] ?>);"></button>
                </div>
                <div class="d-flex align-items-center gap-2 w-100 mt-3">
                    <button type="submit" class="btn btn-warning" onclick="AdicionarItemAoCarrinho(<?= $id ?>)"><i class="bi bi-cart-plus"></i> Adicionar ao carrinho</button>
                    <!-- <button type="button" class="btn btn-warning"><i class="bi bi-cart-check"></i>Comprar agora</button> -->
                </div>


                <hr>
                <strong>Descrição:</strong>
                <p><?= $i['descricao'] ?></p>

            </div>
        </div>
    </div>
</div>
    <script>
{
        window.addEventListener('load', function() {
            //enviar o id do produto para o listar_itens_pedido.php
            const url = new URL(window.location.href);
            const id = url.searchParams.get('id-produto');
        });

        var preco_promocionall = document.getElementById('preco_promocional');
        var precoo = document.getElementById('preco');

        const add = document.querySelector('.bi-plus-circle')
        const sub = document.querySelector('.bi-dash-circle')

    window.AdicionarItemAoCarrinho = async function(id_item) {
            const quantidade = document.getElementById('quantidade').value;

            const response = await fetch('actions/pedido_itens/cadastrar_pedido_itens.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ id_item: id_item, quantidade: quantidade }),
            });

                const data = await response.json();
                if (data.status == 'sucesso') {
                    Swal.fire({
                        title: 'Sucesso',
                        text: data.message,
                        icon: 'success',
                        showConfirmButton: true,
                        confirmButtonText: 'Voltar ao menu',
                        showCancelButton: true,
                        cancelButtonText: 'Abrir o carrinho',
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        allowOutsideClick: false,
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = '/';
                            }else if (result.isDismissed) {
                                window.location.href = 'pages/carrinho.php';
                            }
                    });
                } else {
                    Swal.fire({
                        title: 'Erro',
                        text: data.message,
                        icon: 'error',
                        showConfirmButton: true,
                        confirmButtonText: 'Login',
                        showCancelButton: true,
                        cancelButtonText: 'Cadastre-se',
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        allowOutsideClick: false,
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = '/logar';
                            }else if (result.isDismissed) {
                                window.location.href = '/cadastrar';
                            }
                    });

                }

        }

        function CalcularTotal(preco, preco_promocional) {
            var quantidade = document.getElementById('quantidade').value;

            if (preco_promocional){
                parseFloat(preco_promocional);
                var total_promocional = quantidade * preco_promocional;
                var resultado_promocional = total_promocional.toFixed(2);
                preco_promocionall.innerHTML =`R$${resultado_promocional}`;
            }
            parseInt(quantidade);
            parseFloat(preco);

            var total = quantidade * preco;
            var resultado = total.toFixed(2);
            precoo.innerHTML = `R$${resultado}`;
        }


        function AddQuantidade(preco, preco_promocional) {
            let quantidade = document.getElementById('quantidade').value;
            parseInt(quantidade);
            quantidade++;
            document.getElementById('quantidade').value = quantidade;

            verificarQuantidade();
            CalcularTotal(preco, preco_promocional);
        }

        function verificarQuantidade() {
            let inputQtd = document.getElementById('quantidade');
            let quantidade = parseInt(inputQtd.value) || 1;

            max = 10;
            min = 1;

            if (quantidade >= max) {
                add.hidden = true;
                quantidade = max;
            } else {
                add.hidden = false;
            }

            if (quantidade <= min) {
                sub.hidden = true;
                quantidade = min;
            } else {
                sub.hidden = false;
            }
            inputQtd.value = quantidade;
        }

        function SubQuantidade(preco, preco_promocional) {
            let quantidade = document.getElementById('quantidade').value;
            parseInt(quantidade);
            quantidade--;
            document.getElementById('quantidade').value = quantidade;
            verificarQuantidade();
            CalcularTotal(preco, preco_promocional);
        }
                    }
    </script>

