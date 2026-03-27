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
            box-shadow: 1px 1px 30px rgb(0, 0, 0, 0.2);
            max-width: 350px;
            width: 100%;
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

        .btn-success:hidden, .btn-primary:hidden {
            display: none;
        }
          .btn-success:disabled, .btn-primary:disabled {
            cursor:not-allowed !important;
        }
        input {
            width: 80%;
            padding: 5px;
            border-radius: 5px;
            border: 1px solid #3333335c;
            margin: 0;
            
        }
    </style>
</head>

<body>
    <div class="col-9 px-3 py-2 d-flex justify-content-end align-items-end wrap" style="height: 20vh;">
        <select class="form-select" style="width: 10vw;" aria-label="Default select example">
            <?php foreach ($itens_listar as $i) { ?>
                <option value="<?= $i['id'] ?>"><?= $i['nome'] ?></option>
            <?php } ?>
        </select>
        <button class="ms-1 btn btn-primary"><i class="bi bi-plus-circle"></i> Cadastrar</button>
    </div>
    <div class="d-flex justify-content-center">
        <hr style="width: 50vw;">
    </div>
    <div id="cards-load" class="container-fluid d-flex justify-content-center align-items-start vh-100 gap-5">
     <div class="spinner-border" role="status">
</div>
    </div>


    <script>
        function AtivarPromocao(id) {
            const card = document.querySelector('.id-' + id)
            const chkPromocao = card.querySelector('.chkPromocao')
            const btnSalvar = card.querySelector('.btnSalvar')
            const btnEditar = card.querySelector('.btnEditar')
            const btnExcluir = card.querySelector('.btnExcluir')
            const btnCancelar = card.querySelector('.btnCancelar')
            card.style.opacity = chkPromocao.checked ? "1" : "0.8";
            btnSalvar.disabled = !chkPromocao.checked;
            btnEditar.disabled = !chkPromocao.checked;
            btnExcluir.disabled = chkPromocao.checked;
            btnCancelar.disabled = !chkPromocao.checked;
            btnExcluir.hidden = chkPromocao.checked;

        }

        function CarregarCardsPromocoes(){
            const listPromocoes = <?php echo json_encode($promocoes_listar) ?>;
            const container = document.getElementById('cards-load');
            container.innerHTML = '';

            listPromocoes.forEach(promocao => {
                const isActive = promocao['status'] == 1;
                const opacity = isActive ? 1 : 0.6;
                const checked = isActive ? 'checked' : '';
                        
                container.innerHTML += `
                <div class="card id-${promocao['id']}" style="height: 550px; opacity: ${opacity}">
                <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mt-2">
                <h5 id="nome" class="card-title">${promocao['nome_promocao']}</h5>
                <div class="form-check form-switch">
                <input class="form-check-input chkPromocao" type="checkbox" ${checked} onclick="AtivarPromocao(${promocao['id']})">
                </div>
                </div>
                <hr>
                <img src="../images/${promocao['imagem']}" class="rounded mb-3 border border-white" alt="...">
                <h6 class="fw-bold">Produto: ${promocao['nome']} </h6>
                <div class="d-flex align-items-end">
                <h6 class="me-2 fs-6 fw-bold">Preco: </h6>
                <h6 id="preco" style="color: green;"> ${promocao['preco_promocional']}</h6>
                <h6 class="mx-2"> - </h6>
                <h6 style="text-decoration: line-through; color: red"> ${promocao['preco']}</h6>
                </div>
                <p class="fw-bold">Validade: <span id="validade" class="fw-normal"> ${promocao['data_validade']}</span> </p>
                <hr style="margin-top: -3px;">
                <div class="d-flex justify-content-between">
                <button type="button" class="btn btn-primary btnEditar" onclick="EditarPromocao(${promocao['id']})"><i class="bi bi-pencil-square"></i> Editar</button>
                <button type="button" class="btn btn-success btnSalvar" onclick="SalvarPromocao(${promocao['id']})" hidden><i class="bi bi-check2-square"></i> Salvar</button>
                <button type="button" class="btn btn-danger  btnCancelar" onclick="CancelarPromocao(${promocao['id']})" hidden><i class="bi bi-x-square"></i> Cancelar</button>
                <button type="button" class="btn btn-danger  btnExcluir" onclick="ExcluirPromocao(${promocao['id']})" hidden><i class="bi bi-trash"></i> Excluir</button>
                </div>
                </div>
                </div>
                `;  
                AtivarPromocao(promocao.id);
            });
        }
        setTimeout(CarregarCardsPromocoes, 1000);

        function EditarPromocao(id) {
            const card = document.querySelector('.id-' + id)
            const btnEditar = card.querySelector('.btnEditar')
            const btnSalvar = card.querySelector('.btnSalvar')
            const btnCancelar = card.querySelector('.btnCancelar')
            const btnExcluir = card.querySelector('.btnExcluir')

            btnCancelar.hidden = false;
            btnEditar.hidden = true;
            btnSalvar.hidden = false;

            const idNome = card.querySelector('#nome')
            const idPreco = card.querySelector('#preco')
            const idValidade = card.querySelector('#validade')

            idNome.innerHTML = `<input id="idNome" type="text" value="${idNome.textContent}">`
            idPreco.innerHTML = `<input id="idPreco" type="text" value="${idPreco.textContent}">`
            idValidade.innerHTML = `<input id="idValidade" type="date" value="${idValidade.textContent}">`
        
        }

        function SalvarPromocao(id) {
            const card = document.querySelector('.id-' + id)
        }
    </script>
</body>

</html>