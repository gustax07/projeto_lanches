<?php include('header.php');

if (!isset($_SESSION['usuario'])) {
    header('Location: index.php');
    exit;
}

$usuario = $_SESSION['usuario']; ?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <?php include('./includes/bootstrap_include.php'); ?>
    <link rel="stylesheet" href="css/seguranca.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@40,400,0,0" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tastyburger | minha conta</title>
</head>

<body>
    
    <div class="container my-5">

        <h3 class="text-center mb-4">
            <span class="material-symbols-outlined icon-title">person</span>
            Minha Conta
        </h3>

        <div class="row g-4">

            <div class="col-12 col-md-5">
                <div class="card card-box h-100">
                    <div class="card-body text-center">

                        <img
                            src="images/<?= !empty($usuario['foto']) ? $usuario['foto'] : 'foto_perfil_default.png' ?>"
                            class="foto-perfil mb-3">


                        <h5 class="mb-1"><?= htmlspecialchars($usuario['nome']) ?></h5>

                        <p class="text-muted mb-3"><?= htmlspecialchars($usuario['email']) ?></p>


                        <div class="info-item">
                            <span class="material-symbols-outlined">badge</span>
                            <?= $usuario['id_tipo_fk'] == 0 ? 'Cliente' : 'Funcionário' ?>
                        </div>


                        <div class="info-item">
                            <span class="material-symbols-outlined">calendar_month</span>
                            criado em: <?= date('d/m/Y', strtotime($usuario['data_cadastro'])) ?>
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
                                <input
                                    type="text"
                                    name="nome"
                                    id="nome"
                                    class="form-control"
                                    value="<?= htmlspecialchars($usuario['nome']) ?>">

                            </div>

                            <div class="mb-3">
                                <input
                                    type="email"
                                    name="email"
                                    id="email"
                                    class="form-control"
                                    value="<?= htmlspecialchars($usuario['email']) ?>">

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

                            <button type="submit" class="btn btn-warning w-100">
                                Salvar alterações
                            </button>

                        </form>

                    </div>
                </div>
            </div>

        </div>

    </div>
    <?php include('footer.html'); ?>
</body>

</html>