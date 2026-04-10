<?php

require_once('../classes/promocoes.php');
$promocoes = new Promocoes();
$promocoes_listar = $promocoes->Listar();

require_once('../classes/itens.class.php');
$itens = new Itens();
$itens_listar = $itens->ListarPromocoes();


$itens_em_promocao = array_column($promocoes_listar, 'id_item_fk');

include_once('header.php')
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/promocoes.css">
    <script src="../js/promocoes.js" defer></script>
    <title>Gerenciar Promocoes</title>
</head>

<body>

<!-- sessao de acoes -->
    <div class="container col-lg-6 col-sm-12 px-3 py-2 d-flex justify-content-between align-items-end flex-wrap" style="height: 20vh;">

    <!-- Pesquisa -->
        <div class="d-flex justify-content-start align-items-center gap-2 flex-1">
            <input type="text" class="form-control w-100" id="pesquisa" placeholder="Pesquisar">
            <button class="btn-tasty" type="button" onclick="PesquisarPromocao()"><i class="bi bi-search"></i></button>
        </div>

        <!-- Select para cadastrar uma promocao-->
        <div class="d-flex justify-content-end">
            <select id="select" class="form-select" style="width: 200px;" aria-label="opc">
                <?php foreach ($itens_listar as $i) { //lista apenas os produtos que nao foram criados na promocao
                    if (!in_array($i['id'], $itens_em_promocao)) {
                        echo ('<option  value="' . $i['id'] . '">' . $i['nome'] . '</option>');
                    }
                } ?>
            </select>
            <button class="ms-1 btn-tasty" onclick="AdicionarModal()"><i class="bi bi-plus-circle"></i> Cadastrar</button>
        </div>
    </div>

    <!-- Separador -->
    <div class="d-flex justify-content-center">
        <hr style="width: 50vw;">
    </div>

    <!-- Sessao dos cards de promocoes -->
    <div id="cards-load" class="container-fluid d-flex justify-content-center align-items-start vh-100 gap-5 flex-wrap">
        <div class="spinner-border" role="status">
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="cadastrarPromocoes" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <!-- Titulo do modal -->
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="item_title">Fazer uma Promocao</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Conteudo do modal -->
                <div class="modal-body">
                    
                    <!-- Image -->
                    <div class="d-flex justify-content-center">
                        <div class="img-modal">
                            <img id="Mimg">
                        </div>
                    </div>

                    <!-- Informacoes do produto -->
                    <div class="group-modal">
                        <label for="NomeProduto">Nome do Produto</label>
                        <input id="Mnome" type="text" disabled>
                        <label for="PrecoOriginal">Preço</label>
                        <input id="Mpreco" type="text" disabled>
                        <input id="idItemFk" type="hidden" disabled>
                    </div>

                    <hr>

                    <!-- Informacoes da promocao para cadastrar -->
                    <div class="group-modal">
                        <label for="NomePromocao">Nome da Promoção</label>
                        <input type="text" id="nomePromocao" placeholder="Nome da promocao" require>
                        <label for="PrecoPromocional">Preço</label>
                        <input type="text" id="precoPromocao" placeholder="Preço" require>
                        <label for="DataValidade">Data de Validade</label>
                        <input type="date" id="dataPromocao" placeholder="Data de validade" require>
                    </div>

                </div> <!-- Div do modal-body -->

                <!-- Acoes do modal -->
                <div class="modal-footer">
                    <button type="button" class="btn-cancel-tasty" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn-tasty" onclick="CadastrarPromocao()">Adicionar</button>
                </div> <!-- Div do Footter -->
            </div> <!-- Div do modal-content -->
        </div> <!-- Div do modal-dialog -->
    </div> <!-- Div do modal -->

    <script>
        const promocoes_listar = <?php echo json_encode($promocoes_listar) ?>;
        const itens_listar = <?php echo json_encode($itens_listar) ?>;
       let listPromocoes = <?php echo json_encode($promocoes_listar) ?> ;
    </script>
</body>

</html>