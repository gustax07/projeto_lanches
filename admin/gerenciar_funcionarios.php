<?php
//criar sessao
require_once('../classes/funcionarios.class.php');
$funcionarios = new funcionarios();
$funcionarios_listar = $funcionarios->ListarFuncionarios();
$funcionario = $funcionarios->Listar()[0];


require_once('../classes/cargos.class.php');
$cargos = new Cargos();
$cargos_listar = $cargos->Listar();

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Funcionarios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>
    <div class="container d-flex justify-content-end 3 mt-3">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#cadastrar">Cadastrar novo funcioario</button>
    </div>
    <div class="modal fade" id="cadastrar" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Cadastrar Funcionarios</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="../actions/funcionarios/cadastrar_funcionarios.php" method="post" class="form-floating was-validated" novalidate>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="nome" id="nome" placeholder="Usuario" required>
                            <label for="nome" class="form-label">Nome</label>
                            <div class="invalid-feedback">
                                Esse campo é obrigatório
                            </div>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" name="email" id="email" placeholder="example@gmail.com" required>
                            <label for="email" class="form-label">Email</label>
                            <div class="invalid-feedback">
                                Esse campo é obrigatório
                            </div>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" name="senha" id="senha" placeholder="Senha123" required>
                            <label for="senha" class="form-label">Senha</label>
                            <div class="invalid-feedback">
                                Esse campo é obrigatório
                            </div>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="date" class="form-control" name="data_contratacao" id="data_contratacao" placeholder="XXXX-XX-XX" required>
                            <label for="data_contratacao" class="form-label">Data de Contratação</label>
                            <div class="invalid-feedback">
                                Esse campo é obrigatório
                            </div>
                        </div>
                        <div class="form-floating mb-3">
                            <select class='form-select' name="id_cargos" id="id_cargos" required>
                                <option value="" disabled selected>Selecione um cargos</option>
                                <?php foreach ($cargos_listar as $c) { ?>
                                    <option value="<?= $c['id_cargo'] ?>"> <?= $c['nome_cargo'] ?></option>
                                <?php } ?>
                            </select>
                            <label for="id_cargos" class="form-label">Selecione um cargos</label>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary">Cadastrar</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Listar todos funcionarios cadastrados -->
    <div class="container col-8 displey-flex justify-content-center align-items-center shadow p-3 mb-5 bg-body-white rounded">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Email</th>
                    <th scope="col">Data Contratacao</th>
                    <th scope="col">Cargo</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <?php foreach ($funcionarios_listar as $f) {
                $id = $f['id']; ?>

                <tbody class="table-group-divider">
                    <tr>
                        <td><?= $f['id'] ?></td>
                        <td><?= $f['nome'] ?></td>
                        <td><?= $f['email'] ?></td>
                        <td><?= $f['data_contratacao'] ?></td>
                        <td><?= $f['nome_cargo'] ?></td>
                        <td>
                            <a href="./gerenciar_funcionarios.php?id=<?= $id ?>"><button class="btn btn-primary mx-2"> Editar</button></a>
                            <button class="btn btn-danger">Excluir</button>
                        </td>
                    </tr>
                </tbody>

            <?php } ?>
            <?php
            $funcionario = null;

            if (isset($_GET['id'])) {
                $funcionarios->id = $_GET['id'];
                $funcionario = $funcionarios->ListarPorID()[0];
            }
            ?>

        </table>
    </div>

    <div class="modal fade" id="editar" tabindex="1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Editar Funcionario ID <?= $_GET['id'] ?></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="../actions/funcionarios/editar_funcionarios.php?id=<?= $_GET['id'] ?>" method="post" class="form-floating was-validated" novalidate>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="nome" id="nome" placeholder="Usuario" value="<?= $funcionario['nome'] ?>" required>
                            <label for="nome" class="form-label">Nome</label>
                            <div class="invalid-feedback">
                                Esse campo é obrigatório
                            </div>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" name="email" id="email" placeholder="example@gmail.com" value="<?= $funcionario['email'] ?>" required>
                            <label for="email" class="form-label">Email</label>
                            <div class="invalid-feedback">
                                Esse campo é obrigatório
                            </div>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" name="senha" id="senha" placeholder="Senha123">
                            <label for="senha" class="form-label">Senha</label>
                           
                        </div>
                        <div class="form-floating mb-3">
                            <input type="date" class="form-control" name="data_contratacao" id="data_contratacao" placeholder="XXXX-XX-XX" value="<?= $funcionario['data_contratacao'] ?>" required>
                            <label for="data_contratacao" class="form-label">Data de Contratação</label>
                            <div class="invalid-feedback">
                                Esse campo é obrigatório
                            </div>
                        </div>
                        <div class="form-floating mb-3">
                            <select class='form-select' name="id_cargos_fk" id="id_cargos_fk" required>
                                <option value="" disabled selected>Selecione um cargos</option>
                                <?php foreach ($cargos_listar as $c) { ?>
                                    <option value="<?= $c['id_cargo']; ?>" <?= ($c['id_cargo'] == $funcionario['id_cargos_fk'] ? 'selected' : '') ?>> <?= $c['nome_cargo'] ?></option>
                                <?php } ?>
                            </select>
                            <label for="id_cargos" class="form-label">Selecione um cargos</label>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary">Editar</button>
                </div>
            </form>
            </div>
        </div>
    </div>
    </div>
    <?php if (isset($_GET['id'])): ?>
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                var m = new bootstrap.Modal(document.getElementById('editar'));
                m.show();
            });
        </script>
    <?php endif; ?>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

</body>

</html>