<?php

require_once('../classes/promocoes.php');
$promocoes = new Promocoes();
$promocoes_listar = $promocoes->Listar();

require_once('../classes/itens.class.php');
$itens = new Itens();
$itens_listar = $itens->ListarPromocoes();

include_once('header.php')
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Promocoes</title>
    <style>
        body {
            margin: 0px;
            padding: 0px;
            border: none;
            overflow: hidden;
        }

        .container {
            display: flex;
            justify-content: center;
            flex-direction: row;
            align-items: center;
            height: calc(100vh - 100px);
        }

        .card {
            width: 20rem;
            margin: 10px;
        }

        .card-body {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 100%;
        }

        .card-title {
            margin: 0;
        }

        .form-check {
            display: flex;
            align-items: center;
        }

        .form-check-input {
            margin-right: 10px;
        }

        .form-check-label {
            font-size: 16px;
            font-weight: bold;
            color: #333;
        }

        .card-footer {
            background-color: white;
        }

        .btn-success:disabled {
            display: none;
        }
    </style>
</head>

<body>
    <div class="col-9 px-3 py-2 d-flex justify-content-end align-items-end" style="height: 20vh;">
        <select class="form-select" style="width: 10vw;" aria-label="Default select example">
            <?php foreach ($itens_listar as $i) { ?>
                <option value="<?= $i['id'] ?>"><?= $i['nome'] ?></option>
            <?php } ?>
        </select>
        <button class="btn btn-primary"><i class="bi bi-plus-circle"></i> Cadastrar</button>
    </div>
    <div class="d-flex justify-content-center">
        <hr style="width: 50vw;">
    </div>
    <div class="container-fluid d-flex justify-content-center align-items-start vh-100">
        <?php foreach ($promocoes_listar as $p) { ?>
            <div class="card cardd-<?= $p['id'] ?>" style="height: 500px">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mt-2">
                        <h5 class="card-title"><?= $p['nome_promocao'] ?></h5>
                        <div class="form-check form-switch">
                            <?php if ($p['status'] == 1) {
                                $ativo = 'checked';
                            } else {
                                $ativo = '';
                            }  ?>
                            <input class="form-check-input" type="checkbox" value="<?php echo $ativo == 'checked' ? 1 : 0 ?>" <?= $ativo ?> onclick="AtivarPromocao(<?= $p['id'] ?>)" id="chkPromocao">
                        </div>
                    </div>
                    <hr>
                    <img src="../images/<?= $p['imagem'] ?>" class="rounded mb-3 border border-white" alt="...">
                    <h6 class="fw-bold">Produto: <?= $p['nome'] ?> </h6>
                    <div class="d-flex align-items-end">
                        <h6 class="me-2 fs-6 fw-bold">Preco: </h6>
                        <h6 style="color: green;"> <?= $p['preco_promocional'] ?></h6>
                        <h6 class="mx-2"> - </h6>
                        <h6 style="text-decoration: line-through; color: red"> <?= $p['preco'] ?></h6>
                    </div>
                    <p class="fw-bold">Validade: <span class="fw-normal"><?= $p['data_validade'] ?></span> </p>
                    <hr style="margin-top: -3px;">
                    <div class="d-flex justify-content-end">

                        <button id="btnEditar" type="button" class="btn btn-primary"><i class="bi bi-pencil-square"></i> Editar</button>
                        <button id="btnSalvar" type="button" class="btn btn-success" disabled><i class="bi bi-check2-square"></i> Salvar</button>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>


    <script>
        function AtivarPromocao(id) {
            const card = document.querySelector('.cardd-' + id)
            const chkPromocao = card.querySelector('#chkPromocao')
            const btnSalvar = card.querySelector('#btnSalvar')
            const btnEditar = card.querySelector('#btnEditar')

            if (!chkPromocao.checked) {
                card.style.opacity = 0.6;
                card.disabled = false;

            } else {
                card.style.opacity = 1
                card.disabled = true;
            }

        }
    </script>
</body>

</html>