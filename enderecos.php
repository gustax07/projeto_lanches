<?php
session_start();
include('header.php');
include('includes/bootstrap_include.php');
require_once('classes/enderecos.class.php');


$enderecos = new Enderecos();
$idUsuario = $_SESSION['usuario']['id'];
$enderecos_listar = $enderecos->ListarPorID($idUsuario);


?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" href="images/icon_burguer.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tasty Burguer | meus endereços</title>
</head>

<body>
    <style>
        body {
            background-color: #f5f5f5;
        }

        .card-padrao {
            border-radius: 20px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
        }

        .btn-principal {
            background-color: #FFC781;
            border: none;
            font-weight: bold;
        }

        .btn-principal:hover {
            background-color: #e9b56f;
        }

        /* endereço listado */
        .endereco-item {
            border: 2px solid transparent;
            border-radius: 15px;
            padding: 15px;
            cursor: pointer;
            transition: 0.3s;
            background-color: #fff;
        }

        .endereco-item:hover {
            border-color: #FFC781;
            background-color: #fff8ec;
        }


        .endereco-item.ativo {
            border-color: #FFC781;
            background-color: #fff4e1;
        }

        .acoes-endereco {
            display: none;

        }

        .acoes-endereco.mostrar {
            display: flex;
            gap: 10px;
        }
    </style>
    </head>

    <body>

        <div class="container py-5">
            <div class="row g-4">

                <div class="col-12 col-lg-4">
                    <div class="card card-padrao p-4">
                        <h4 class="mb-4 text-center">Novo Endereço</h4>



                        <form method="POST" action="actions/enderecos/cadastrar_enderecos.php">

                            <div class="mb-4">
                                <label class="form-label">CEP</label>
                                <input type="text" class="form-control" id="cep" name="cep" style="border: 3px solid orange">
                                <a onclick="BuscarEndereco()" class="btn btn-principal mt-3">buscar</a>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Rua</label>
                                <input type="text" id="logradouro" class="form-control" name="rua">
                            </div>

                            <div class="row">
                                <div class="col-4 mb-3">
                                    <label class="form-label">Número</label>
                                    <input type="text" class="form-control" name="numero">
                                </div>
                                <div class="col-8 mb-3">
                                    <label class="form-label">Bairro</label>
                                    <input type="text" id="bairro" class="form-control" name="bairro">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-8 mb-3">
                                    <label class="form-label">Cidade</label>
                                    <input type="text" id="localidade" class="form-control" name="cidade">
                                </div>
                                <div class="col-4 mb-3">
                                    <label class="form-label">Estado</label>
                                    <input type="text" class="form-control" id="estado" name="estado" maxlength="2">
                                </div>
                            </div>



                            <div class="d-grid">
                                <button type="submit" class="btn btn-principal btn-lg">Cadastrar Endereço</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-12 col-lg-8">
                    <div class="card card-padrao p-4">
                        <h4 class="mb-4">Meus Endereços</h4>

                        <?php if (count($enderecos_listar) == 0): ?>
                            <p>Nenhum endereço cadastrado.</p>
                        <?php else: ?>
                            <?php foreach ($enderecos_listar as $e): ?>
                                <div class="card mb-2 endereco-item">
                                    <div class="card-body">
                                        <strong><?= $e['rua'] ?>, <?= $e['numero'] ?></strong><br>
                                        <?= $e['bairro'] ?> - <?= $e['cidade'] ?>/<?= $e['estado'] ?><br>
                                        CEP: <?= $e['cep'] ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>


                        <!-- ações -->
                        <div class="acoes-endereco mostrar mt-3">
                            <button id="btnEditar" class="btn btn-outline-primary">Editar</button>
                            <button id="btnExcluir" class="btn btn-outline-danger">Excluir</button>
                        </div>

                    </div>
                </div>

            </div>
        </div>
        <?php include('footer.html'); ?>

        <script>
            const enderecos = document.querySelectorAll('.endereco-item');
            const acoes = document.querySelector('.acoes-endereco');

            enderecos.forEach(endereco => {
                endereco.addEventListener('click', () => {

                    enderecos.forEach(e => e.classList.remove('ativo'));

                    endereco.classList.add('ativo');

                    acoes.classList.add('mostrar');
                });
            });



            async function BuscarEndereco() {

                try {
                    let cep = document.getElementById("cep").value;
                    let url = `https://viacep.com.br/ws/${cep}/json/`;
                    const response = await fetch(url);
                    const endereco = await response.json();
                    document.getElementById("logradouro").value = endereco.logradouro;
                    document.getElementById("bairro").value = endereco.bairro;
                    document.getElementById("localidade").value = endereco.localidade;
                    document.getElementById("estado").value = endereco.uf;
                } catch (error) {
                    console.error('Erro ao buscar endereço:', error);
                }

            }


            
        </script>

    </body>

</html>