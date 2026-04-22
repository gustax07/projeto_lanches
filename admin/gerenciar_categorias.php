<?php

require_once __DIR__ . '../../vendor/autoload.php';
use App\Categorias;
$categorias = new Categorias();
$categorias_listar = $categorias->Listar();
$categorias->nome = $_GET['pesquisar'] ?? '';
$categorias_pesquisa = $categorias->PesquisarPorNome();

include('header.php');
function Table($categories) {
    echo "<table class='table table-striped table-hover responsive'>";
    echo "<thead>";
    echo "<tr class='table-dark text-center'>";
    echo "<th>ID</th>";
    echo "<th>Nome</th>";
    echo "<th>Ações</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";
    
    foreach ($categories as $category) {
        echo "<tr class='text-center'>";
        echo "<td>{$category['id']}</td>";
        echo "<td>{$category['nome']}</td>";
        echo "<td>";
        echo "<button class='btn btn-primary mx-2' data-bs-toggle='modal' data-bs-target='#modal' data-form='../actions/categorias/editar_categorias.php' data-id='{$category['id']}' data-nome='{$category['nome']}'>Editar</button>";
        echo "<button class='btn btn-danger' onclick=\"excluir({$category['id']}, '{$category['nome']}')\">Excluir</button>";
        echo "</td>";
        echo "</tr>";
    }
    
    echo "</tbody>";
    echo "</table>";
}
include('../includes/bootstrap_include.php');
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Categorias</title>
</head>

<body>
    <div class="container col shadow p-3 mt-5 bg-body-white rounded">
        <div class="d-flex justify-content-between mb-3 ">
            <form action="../actions/categorias/pesquisar_categorias.php" method="post">
            <div class="d-flex justify-content-start">
                <input type="text" class="form-control w-50" name="nome" placeholder="Pesquisar" value="<?php if (!empty($_GET['pesquisar'])) {echo $_GET['pesquisar'];} ?>">
                <button class="btn btn-primary"><i class="bi bi-search"></i></button>
            </div>
        </form>
            <div class="d-flex justify-content-end">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal" data-form="../actions/categorias/cadastrar_categorias.php">Cadastrar</button>
            </div>
        </div>
        
        <?php
        if (!empty($_GET['pesquisar'])) {
            Table($categorias_pesquisa);
        }else {

            Table($categorias_listar);
        }
        ?>
    </div>

    <div class="modal fade" id="modal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" id="forms">
                        <div class="mb-3">
                            <label for="nome" class="col-form-label">Nome</label>
                            <input type="text" class="form-control" id="nome" name="nome" required>
                            <input type="hidden" class="form-control" id="id" name="id" required>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>

        const modal = document.getElementById('modal')
        if (modal) 
        {
            modal.addEventListener('show.bs.modal', event => 
            {
                const button = event.relatedTarget

                const valor = button.getAttribute('data-nome')

                const modalTitle = modal.querySelector('.modal-title')
                const inputNome = modal.querySelector('.modal-body #nome')
                const forms = modal.querySelector('#forms')
                const inputId = modal.querySelector('#forms #id')

                forms.setAttribute('action', button.getAttribute('data-form'))

                if (valor !== null) {
                    modalTitle.textContent = `Editando ${valor}`
                    inputNome.value = button.getAttribute('data-nome')
                    inputId.value = button.getAttribute('data-id')
                } else {
                    modalTitle.textContent = `Cadastrando`
                    inputNome.value = ''
                }

            })
        }

           function excluir(id, nome) {
                Swal.fire({
                    title: "Aviso!",
                    text: "Você tem certeza que deseja excluir a categoria " + nome + "?",
                    icon: "warning",
                    showCancelButton: true,
                    cancelButtonColor: " #3085d6",
                    confirmButtonColor: "#d33",
                    cancelButtonText: "Não, cancelar!",
                    confirmButtonText: "Sim, excluir!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "../actions/categorias/remover_categorias.php?id=" + id;
                    }
                });
            }

    </script>
</body>

</html>