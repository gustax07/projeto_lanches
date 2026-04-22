<link rel="stylesheet" href="css/seguranca.css">
<script src="js/conta.js" defer></script>
<title>Minha conta</title>

<div class="conta">
    <div class="header-backgroud"></div>
    <div class="container mb-5">

        <h3 class="text-center mb-4">
            <span class="bi bi-person-fill icon-title"></span>
            Minha Conta
        </h3>

        <div class="row g-4">

            <div class="col-12 col-md-5">
                <div class="card card-box p-2 h-100">
                    <div class="card-body">

                        <div class="d-flex justify-content-center">
                            <img id="imgPerfi" class="foto-perfil placeholder mb-3">
                        </div>

                        <h5 class="nome-user mb-3 text-center">
                            <span id="nomePerfil">
                                <p class="placeholder-glow">
                                    <span class="placeholder col-12"></span>
                                </p>
                            </span>
                        </h5>

                        <hr>

                        <div class="container">

                            <div class="info-item mb-1">
                                <i class="bi bi-envelope-at-fill"></i>
                                <span class="titulo-item">Email</span>
                                <p id="emailPerfil" class="placeholder-glow">
                                    <span class="placeholder col-12"></span>
                                </p>
                            </div>

                            <div class="info-item mb-1">
                                <i class="bi bi-person-vcard-fill"></i>
                                <span class="titulo-item">Tipo de Conta</span>
                                <p id="cargoPerfil" class="placeholder-glow">
                                    <span class="placeholder col-12"></span>
                                </p>
                            </div>


                            <div class="info-item mb-1">
                                <i class="bi bi-calendar-date-fill"></i>
                                <span class="titulo-item">Data de cadastro</span>
                                <p id="dataCadastroPerfil" class="placeholder-glow">
                                    <span class="placeholder col-12"></span>
                                </p>
                            </div>

                            <div class="d-grid gap-2">
                                <button class="btn btn-warning w-100 text-white">
                                    <i class="bi bi-pencil-square"></i> Alterar Foto de Perfil
                                </button>
                                <button class="btn btn-warning w-100 text-white">
                                    <i class="bi bi-box-arrow-right"></i> Editar Informações
                                </button>
                                <button class="btn btn-warning w-100 text-white">
                                    <i class="bi bi-lock-fill"></i> Alterar Senha
                                </button>
                                <button class="btn btn-danger w-100 text-white">
                                    <i class="bi bi-trash"></i> Excluir Conta
                                </button>

                            </div>

                        </div>

                    </div>
                </div>
            </div>


            <div class="col-12 col-md-7">
                <div class="card card-box h-100">
                    <div class="card-body">

                        <h5 class="section-title">Editar informações</h5>

                        <form action="actions/clientes/editar_clientes.php" method="POST">

                            <div class="mb-3">
                                <input type="text" name="nome" id="nome" class="form-control">
                            </div>

                            <div class="mb-3">
                                <input type="email" name="email" id="email" class="form-control">
                            </div>

                            <hr>

                            <h6 class="section-subtitle">Alterar senha</h6>

                            <div class="mb-3">
                                <label class="form-label">Senha atual</label>
                                <input type="password" name="senhaAtual" id="senhaAtual" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Nova senha</label>
                                <input type="password" name="senha" id="senha" class="form-control">
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Confirmar nova senha</label>
                                <input type="password" name="confirmarSenha" id="confirmarSenha" class="form-control">
                            </div>

                            <button type="submit" class="btn btn-warning w-100 text-white">
                                Salvar alterações
                            </button>

                        </form>

                    </div>
                </div>
            </div>

        </div>

    </div>
    <script>

    </script>
</div>