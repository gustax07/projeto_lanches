<?php
//criar sessao
require_once('../classes/usuarios.class.php');
$usuarios = new Usuarios();
$usuarios_listar = $usuarios->ListarFuncionariosPorINNERJOIN();

$usuarios->id_tipo_fk = $_GET['id_tipo_fk'] ?? 0;
$listarPorCargo = $usuarios->ListarFuncionariosPorINNERJOINECARGO();

require_once('../classes/tipos.class.php');
$tipos = new Tipos();
$tipos_listar = $tipos->Listar();

unset($tipos_listar[0]);
include('header.php');
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Funcionarios</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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

        <form action="../actions/funcionarios/filtrar_funcionarios.php" method="POST" novalidate>
            <div class="row align-items-center mb-3 justify-content-between">
                <div class="col-auto">
                    <div class="input-group mb-3">
                        <select class='form-select' name="id_tipo_fk" id="id_tipo_fk" required>
                            <option value="0">Todos</option>
                            <?php
                                
                             foreach ($tipos_listar as $tipo) { ?>
                                <option value="<?= $tipo['id'] ?>"> <?= $tipo['nome_tipo'] ?>
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

    <?php if (empty($_GET['id_tipo_fk'])) {
        if (count($usuarios_listar) == 0) {
            echo "Nenhum funcionario cadastrado";
        }else {
        Tabela($usuarios_listar);
        }
    }else {
        if (count($listarPorCargo) == 0) {
           echo "<div class='alert alert-danger' role='alert'>
                            Nenhum funcionario encontrado
                    </div>";
        }
        else{
        Tabela($listarPorCargo);
        }
    }

    function Tabela($tabela)
    { ?>
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover ">
                <thead>
                    <tr class="table-dark text-center">
                        <th scope="col">#</th>
                        <th scope="col">Foto</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Email</th>
                        <th scope="col">Data de Cadastro</th>
                        <th scope="col">Cargo</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>
                <?php foreach ($tabela as $u) {  ?>
                    <tbody class="table-group-divider">
                        <tr class="text-center">
                            <td><?= $u['id'] ?></td>
                            <td><img src="../images/<?= $u['foto'] ?>" width="50px" height="50px" ></td>
                            <td><?= $u['nome'] ?></td>
                            <td><?= $u['email'] ?></td>
                            <td><?= $u['data_cadastro'] ?></td>
                            <td><?= $u['cargo'] ?></td>
                            <td>
                                <button class="btn btn-primary mx-2" data-bs-toggle="modal" data-bs-target="#editar" 
                                data-id="<?= $u['id'] ?>" 
                                data-nome="<?= $u['nome'] ?>" 
                                data-email="<?= $u['email'] ?>" 
                                data-cargo="<?= $u['id_tipo_fk'] ?>"> Editar</button>
                                <button class="btn btn-danger" onclick="excluir(<?= $u['id'] ?>, '<?= $u['nome'] ?>')">Excluir</button>
                            </td>
                        </tr>
                    </tbody>
            <?php }
            } ?>
            </table>
        </div>

        <div class="modal fade" id="editar" tabindex="1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Editar Funcionario</h1>
                    </div>
                    <div class="modal-body">
                    <form action='../actions/funcionarios/editar_funcionarios.php' method='post' class='form-floating was-validated' novalidate>
                        <input type="hidden" name="id" id="id">
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
                            <input type="password" class="form-control" name="senha" id="senha" placeholder="Senha123">
                            <label for="senha" class="form-label">Senha</label>
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
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                            <button type="submit" class="btn btn-primary">Editar</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </div>

        <script>
            const modal = document.getElementById('editar')
            if (modal){
            modal.addEventListener('show.bs.modal', event => {
                var button = event.relatedTarget;
                const inputNome = modal.querySelector('.modal-body #nome');
                const inputEmail = modal.querySelector('.modal-body #email');
                const inputCargo = modal.querySelector('.modal-body #id_tipo_fk');
                const inputId = modal.querySelector('.modal-body #id');

                inputNome.value = button.getAttribute('data-nome');
                inputEmail.value = button.getAttribute('data-email');
                inputCargo.value = button.getAttribute('data-cargo');
                inputId.value = button.getAttribute('data-id');


            })
            }

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
        <?php include_once('../includes/sweet_alert2_include.php');
        include_once('../includes/bootstrap_include.php'); ?>

</body>

</html>