<title>Meus Endereços</title>
<link rel="stylesheet" href="css/enderecos.css">
<script src="js/enderecos.js" defer></script>

<div class="header-backgroud"></div>
<div class="endereco">
    <div class="container mb-5">
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
                <div class="card card-padrao p-4 h-100">
                    <h4 class="mb-4">Meus Endereços</h4>
                    <div id="cards-enderecos">
                        <div class="d-flex aign-items-center justify-content-center">
                            <div class="spinner-border" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

    <script>

    </script>