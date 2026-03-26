<?php


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
        .card-footer{
            background-color: white;
        }
        .btn-success:disabled {
            display: none;
        }
        
    </style>
</head>

<body>
    <!-- Criar os cards de exemplo com checkbox toggle em cima do card -->
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mt-2">
                    <h5 class="card-title">Produto</h5>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" value="1" checked id="chkPromocao">
                    </div>
                </div>
                <hr>
                <img src="../images/banner_1_burguer.png" class="rounded mb-3" alt="...">
                <div class="d-flex align-items-end">
                    <h6 class="me-2 fs-6 fw-bold">Preco: </h6>
                    <h6 style="color: green;"> R$ 0,00</h6>
                    <h6 class="mx-2"> - </h6>
                    <h6 style="text-decoration: line-through; color: red"> R$ 0,00</h6>
                </div>
                <p class="fw-bold">Validade: <span class="fw-normal">DD/MM/YYYY</span> </p>
                <hr style="margin-top: -3px;">
                <div class="d-flex justify-content-end">
                    <button id="btnEditar" type="button" class="btn btn-primary"><i class="bi bi-pencil-square"></i> Editar</button>
                    <button id="btnSalvar" type="button" class="btn btn-success" disabled><i class="bi bi-check2-square"></i> Salvar</button>
                </div>
            </div>
        </div>
    </div>

        <script>
            const chkPromocao = document.getElementById('chkPromocao');
            const btnEditar = document.getElementById('btnEditar');
            const btnSalvar = document.getElementById('btnSalvar');

            if (chkPromocao.checked){
                
            }
        </script>
</body>

</html>