<?php

require('../classes/itens.class.php');
$itens = new Itens();
$itens_listar = $itens->ListarInnerJoin();

$pesquisa = $_GET['pesquisar'] ?? '';
$listar_por_nome = $itens->PesquisarPorNome($pesquisa);

require('../classes/categorias.class.php');
$categorias = new Categorias();
$categorias_listar = $categorias->Listar();

include('header.php');

?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Produtos</title>
    <style>
        img {
            border: 0px !important;
            border-radius: 0px !important;
        }
    </style>
</head>

<body>
     <?php function Table($listar)
    { ?>
    <div class="table-responsive">
        <table class="table table-striped table-hover table-responsive text-center">
            <thead>
                <tr class="table-dark">
                    <th scope="col">Imagem</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Descrição</th>
                    <th scope="col">Categoria</th>
                    <th scope="col">Preco</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
                <?php foreach ($listar as $item): ?>
                    <tr>
                        <td><img src="../images/<?= $item['imagem'] ?>" width="40px" height="40px"></td>
                        <td><?= $item['nome'] ?></td>
                        <td><?= $item['descricao'] ?></td>
                        <td><?= $item['categoria'] ?></td>
                        <td>R$<?= $item['preco'] ?></td>
                        <td>
                            <button data-bs-toggle="modal" data-bs-target="#modal" data-titulo="Editar <?= $item['nome'] ?>"
                                data-id="<?= $item['id'] ?>" 
                                data-nome="<?= $item['nome'] ?>" 
                                data-descricao="<?= $item['descricao'] ?>" 
                                data-categoria="<?= $item['id_categoria_fk'] ?>" 
                                data-preco="<?= $item['preco'] ?>" 
                                data-foto="<?= $item['imagem'] ?>"
                                class="btn btn-primary"> Editar </button>
                            <button onclick="excluir(<?= $item['id'] ?>, '<?= $item['nome'] ?>')" class="btn btn-danger"> Excluir </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
        </table>
    </div>
    <?php } ?>

    <div class="container-fluid col-sm-12 col-md-8 shadow p-3 mt-5 bg-body-white rounded">
        <div class="d-flex justify-content-between mb-3">
            <form action="../actions/itens/pesquisar_itens.php" method="post">
                <div class="d-flex justify-content-start">
                    <input class="form-control me-2" type="search" placeholder="Pesquisar" name="pesquisar" value="<?= $_GET['pesquisar'] ?? '' ?>" aria-label="Search">
                    <button class="btn btn-primary" type="submit"><i class="bi bi-search"></i></button>
                </div>
            </form>
            <div class="d-flex justify-content-end">
                <button href="cadastrar_produtos.php" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal" data-titulo="Cadastrar"> Cadastrar </button>
            </div>
        </div>
        <?php if (empty($_GET['pesquisar'])) {
            if (empty($itens_listar)) {
                echo "<div class='alert alert-danger' role='alert'>
                            Nenhum item encontrado
                    </div>";
            }else {
                Table($itens_listar);

            }
        } else {
            if (empty($listar_por_nome)) {
                 echo "<div class='alert alert-danger' role='alert'>
                            Nenhum item encontrado
                    </div>";
            }else{

                Table($listar_por_nome);
            }
        }
        ?>

    </div>

    <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="forms" action="../actions/itens/cadastrar_itens.php" method="post" enctype="multipart/form-data">
                        <div class="col d-flex justify-content-center mb-1">
                            <img id="previewImg" src="../images/foto_perfil_default.png" alt="" width="100px" height="100px" class="border ">
                            <input type="file" name="foto" id="inputFoto" accept="image/*" class="d-none" aria-hidden>
                        </div>
                        <div class="d-flex align-items-center justify-content-center">
                            <button type="button" class="btn btn-primary btn-sm" onclick="abrirSeletor()">Alterar Foto</button>
                        </div>
                        <div class="mb-3">
                            <label for="nome" class="col-form-label">Nome</label>
                            <input type="text" class="form-control" id="nome" name="nome">
                        </div>
                        <div class="mb-3">
                            <label for="descricao" class="col-form-label">Descrição</label>
                            <input type="text" class="form-control" id="descricao" name="descricao">
                        </div>
                        <div class="mb-3">
                            <label for="id_categoria_fk" class="col-form-label">Categoria</label>
                            <select class='form-select' name="id_categoria_fk" id="id_categoria_fk">
                                <option value="">Selecione uma categoria</option>
                                <?php foreach ($categorias_listar as $categoria): ?>
                                    <option value="<?= $categoria['id'] ?>"><?= $categoria['nome'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="preco" class="col-form-label">Preço</label>
                            <input type="text" class="form-control" id="preco" name="preco">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        const modal = document.getElementById('modal');
        if (modal) {
            modal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget;
                const titulo = button.getAttribute('data-titulo');
                const modalTitle = modal.querySelector('.modal-title');
                const inputNome = modal.querySelector('.modal-body #nome');
                const inputDescricao = modal.querySelector('.modal-body #descricao');
                const inputCategoria = modal.querySelector('.modal-body #id_categoria_fk');
                const inputPreco = modal.querySelector('.modal-body #preco');
                const inputFoto = modal.querySelector('.modal-body #inputFoto');
                const id = button.getAttribute('data-id');
                const forms = modal.querySelector('#forms');
                const previewImg = modal.querySelector('.modal-body #previewImg');

                modalTitle.textContent = titulo;
                if (titulo === 'Cadastrar') {
                    inputNome.value = '';
                    inputDescricao.value = '';
                    inputCategoria.value = '';
                    inputPreco.value = '';
                    inputFoto.value = '';
                    previewImg.src = '../images/foto_perfil_default.png';
                } else {
                    forms.setAttribute('action', '../actions/itens/editar_itens.php?id=' + id);

                    // atribui os valores ao campos
                    inputNome.value = button.getAttribute('data-nome');
                    inputDescricao.value = button.getAttribute('data-descricao');
                    inputCategoria.value = button.getAttribute('data-categoria');
                    inputPreco.value = button.getAttribute('data-preco');

                    // alterar o src da imagem  
                    previewImg.src = '../images/' + button.getAttribute('data-foto');

                }
            });
        }

        function abrirSeletor() {
            document.getElementById('inputFoto').click();
        }

        document.getElementById('inputFoto').addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('previewImg').src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });

        function excluir(id, nome) {
            Swal.fire({
                title: "Aviso!",
                text: "Você tem certeza que deseja excluir esse item " + nome + "?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Sim, excluir!",
                cancelButtonText: "Não, cancelar!"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "../actions/itens/excluir_itens.php?id=" + id;
                }
            });

        }
    </script>
   
</body>

</html>