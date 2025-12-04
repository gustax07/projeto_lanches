<?php
//criar sessao
require_once('../classes/funcionarios.class.php');
$funcionarios = new funcionarios();
$funcionarios_listar = $funcionarios->Listar();

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
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Cadastrar novo funcioario</button>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-hidden="true">
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
                            <div  class="invalid-feedback">
                            Preencha o campo
                        </div>
                        </div>
                       
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" name="email" id="email" placeholder="example@gmail.com" required>
                            <label for="email" class="form-label">Email</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" name="senha" id="senha" placeholder="Senha123" required>
                            <label for="senha" class="form-label">Senha</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="date" class="form-control" name="data_contratacao" id="data_contratacao" placeholder="XXXX-XX-XX" required>
                            <label for="data_contratacao" class="form-label">Data de Contratação</label>
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
    <table>
        <tr>
            <th>Nome</th>
            <th>Email</th>
            <th>Data Contratacao</th>
            <th>Cargo</th>
            <th>Ações</th>
        </tr>
        <?php foreach ($funcionarios_listar as $f) { ?>
            <tr>
                <td><?= $f['nome'] ?></td>
                <td><?= $f['email'] ?></td>
                <td><?= $f['data_contratacao'] ?></td>
                <td><?= $f['id_cargos_fk'] ?></td>
                <td>
                    <a href="editar.php?id=<?= $f['id'] ?>">Editar</a>
                    <a href="../actions/funcionarios/remover_funcionarios.php?id=<?= $f['id'] ?>">Excluir</a>
                </td>
            </tr>
        <?php } ?>
    </table>


    <h1>Cadastrar Funcionarios</h1>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

</body>

</html>