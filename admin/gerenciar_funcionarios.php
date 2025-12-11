<?php
//criar sessao
require_once('../classes/usuarios.class.php');
$usuarios = new Usuarios();
$usuario = $usuarios->Listar()[0];

require_once('../classes/tipos.class.php');
$tipos = new Tipos();
$tipos_listar = $tipos->Listar();

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
                            <select class='form-select' name="id_tipo_fk" id="id_tipo_fk" required>
                                <option value="" disabled selected>Selecione um cargos</option>
                                <?php foreach ($tipos_listar as $c) { ?>
                                    <option value="<?= $c['id'] ?>"> <?= $c['nome_tipo'] ?></option>
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
    <div class="container col-8 displey-flex justify-content-center align-items-center shadow p-3 mt-5  bg-body-white rounded">
        <h1 class="text-center mt-5 mb-5">Gerenciar Funcionários</h1>

        <form action="gerenciar_funcionarios.php" method="get" novalidate>
            <div class="row align-items-center mb-3 justify-content-between">
                <div class="col-auto">
                    <div class="input-group mb-3">
                        <select class='form-select' name="id_tipo_fk" id="id_tipo_fk" required>
                            <option value="-1">Todos</option>
                            <?php foreach ($tipos_listar as $tipo) { ?>
                                <option value="<?= $tipo['id'] ?>" <?= ($tipo['id'] == $_GET['id_tipo_fk'] ? 'selected' : '') ?>> <?= $tipo['nome_tipo'] ?>
                                </option>;
                            <?php } ?>
                        </select>

                        <button class="btn btn-primary mx-1">Aplicar</button>
                    </div>
                </div>
        </form>

        <div class="col-auto d-flex justify-content-end">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#cadastrar">
                Cadastrar novo funcionário
            </button>
        </div>

    </div>


    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">Email</th>
                <th scope="col">Data de Cadastro</th>
                <th scope="col">Cargo</th>
                <th scope="col">Ações</th>
            </tr>
        </thead>
        <?php if ($_GET['id_tipo_fk'] != '-1') {

            $usuarios->id_tipo_fk = $_GET['id_tipo_fk'];
            foreach ($usuarios->ListarPorIDCargo() as $u) { ?>
                <tbody class="table-group-divider">
                    <tr>
                        <td><?= $u['id'] ?></td>
                        <td><?= $u['nome'] ?></td>
                        <td><?= $u['email'] ?></td>
                        <td><?= $u['data_cadastro'] ?></td>
                        <td><?= $u['id_tipo_fk'] ?></td>
                        <td>
                            <a href="./gerenciar_funcionarios.php?id=<?= $u['id'] ?>"><button class="btn btn-primary mx-2"> Editar</button></a>
                            <button class="btn btn-danger" onclick="excluir(<?= $u['id'] ?>, '<?= $u['nome'] ?>')">Excluir</button>
                        </td>
                    </tr>
                </tbody>
            <?php }

        } elseif ($_GET['id_tipo_fk'] == '-1') {
            
            
            $usuarios_listar = $usuarios->ListarFuncionarios();
            
           
            ?>
          
            <?php foreach ($usuarios_listar as $f) {
                $id = $f['id']; ?>

                <tbody class="table-group-divider">
                    <tr>
                        <td><?= $f['id'] ?></td>
                        <td><?= $f['nome'] ?></td>
                        <td><?= $f['email'] ?></td>
                        <td><?= $f['data_cadastro'] ?></td>
                        <td><?= $f['nome_tipo'] ?></td>
                        <td>
                            <a href="./gerenciar_funcionarios.php?id_tipo_fk=-1&id=<?= $id ?>"><button class="btn btn-primary mx-2"> Editar</button></a>
                            <button class="btn btn-danger" onclick="excluir(<?= $id ?>, '<?= $f['nome'] ?>')">Excluir</button>
                        </td>
                    </tr>
                </tbody>
        <?php }
        }?>
        <?php
        $usuario = null;

        if (isset($_GET['id'])) {
            $usuarios->id = $_GET['id'];
            $usuario = $usuarios->ListarPorID()[0];
        }
        ?>

    </table>
    </div>

    <div class="modal fade" id="editar" tabindex="1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Editar Funcionario ID <?= $_GET['id'] ?></h1>
                </div>
                <div class="modal-body">
                    <form action="../actions/funcionarios/editar_funcionarios.php?id=<?= $_GET['id'] ?>" method="post" class="form-floating was-validated" novalidate>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="nome" id="nome" placeholder="Usuario" value="<?= $usuario['nome'] ?>" required>
                            <label for="nome" class="form-label">Nome</label>
                            <div class="invalid-feedback">
                                Esse campo é obrigatório
                            </div>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" name="email" id="email" placeholder="example@gmail.com" value="<?= $usuario['email'] ?>" required>
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
                            <select class='form-select' name="id_tipo_fk" id="id_tipo_fk" required>
                                <option value="" disabled selected>Selecione um cargos</option>
                                <?php foreach ($tipos_listar as $t) { ?>
                                    <option value="<?= $t['id']; ?>" <?= ($t['id'] == $usuario['id_tipo_fk'] ? 'selected' : '') ?>> <?= $t['nome_tipo'] ?></option>
                                <?php } ?>
                            </select>
                            <label for="id_cargos" class="form-label">Selecione um cargos</label>
                        </div>
                </div>
                <div class="modal-footer">
                    <a href="./gerenciar_funcionarios.php?id_tipo_fk=-1"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button></a>
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

    <script>
        function excluir(id, nome) {
            Swal.fire({
                title: "Aviso!",
                text: "Você tem certeza que deseja excluir o usuario " + nome + "?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Sim, excluir!",
                cancelButtonText: "Não, cancelar!"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "../actions/funcionarios/remover_funcionarios.php?id=" + id;
                }
            });
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <?php include_once('../includes/sweet_alert2_include.php'); ?>

</body>

</html>