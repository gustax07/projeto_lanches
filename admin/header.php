<?php
session_start();

if ($_SESSION['usuario']['id_tipo_fk'] == 0) {
  header('Location: ../index.php');
  exit;
}
$foto = $_SESSION['usuario']['foto'];

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="../css/header_admin.css">
  <title>Painel Administrador</title>
  <style>
    .perfil-offcanvas {
      display: flex;
      flex-direction: column;
      align-items: center;
      text-align: center;
      gap: 8px;
      margin-bottom: 20px;
    }


    .perfil-offcanvas img {
      width: 90px;
      height: 90px;
      border-radius: 50%;
      object-fit: cover;
      border: 2px solid #FFC781;
    }

    .perfil-offcanvas h5 {
      margin: 0;
      font-weight: 600;
    }

    .perfil-offcanvas small {
      color: #666;
    }

    a:hover {
      color: #FFC781 !important;
    }

    .btn-danger:hover,
    .btn-outline-dark:hover {
      color: #f1ece6 !important;
      transform: translateY(0px) !important;
    }
  </style>
</head>

<body>
  <nav class="navbar navbar-expand-lg bg-body-tertiary shadow-lg py-2">
    <div class="container-fluid px-4">

      <a class="navbar-brand d-flex align-items-center fs-2 fw-bold" href="../index.php">
        <img src="../images/icon_burguer.png" alt="Logo" width="65" height="60" class="me-3 d-inline-block align-text-top">
        Tasty Burger
      </a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuNavegacao" aria-controls="menuNavegacao" aria-expanded="false" aria-label="Alternar navegação">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="menuNavegacao">

        <ul class="navbar-nav mx-auto gap-3 fs-5 text-center mt-3 mt-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="index.php"><i class="bi bi-house-door-fill"></i> Inicial</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="pedidos.php"><i class="bi bi-box-seam-fill"></i> Pedidos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="gerenciar_funcionarios.php"><i class="bi bi-people-fill"></i> Funcionários</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="gerenciar_categorias.php"><i class="bi bi-tags-fill"></i> Categorias</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="gerenciar_produtos.php"><i class="bi bi-basket-fill"></i> Produtos</a>
          </li>
        </ul>

        <div class="d-flex justify-content-center align-items-center mt-3 mt-lg-0">
          <button class="btn btn-light d-flex align-items-center gap-2 border-0 shadow-sm rounded-pill px-3 py-2" data-bs-toggle="offcanvas"
            href="#offcanvasExample"
            role="button"
            aria-controls="offcanvasExample">
            <img src="../images/<?= $foto ?>" alt="Foto" width="40" height="40" class="rounded-circle object-fit-cover">
            <span class="fs-6 fw-bold mb-0 text-dark"><?= $_SESSION['usuario']['nome'] ?></span>
          </button>
        </div>

      </div>
    </div>
  </nav>
  <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
    <div class="offcanvas-header">
      <h5 class="offcanvas-title" id="offcanvasExampleLabel">Meu perfil</h5>
      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
      <div>

        <div class="perfil-offcanvas">
          <img src="../images/<?= $foto ?>" alt="Foto do usuário">

          <h3><?= $_SESSION['usuario']['nome'] ?></h3>
          <p><?= $_SESSION['usuario']['email'] ?></p>
        </div>
        <!-- começo do acordion -->
        <div class="accordion" id="accordionExample">
          <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
              <button class="accordion-button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                Configurações do perfil
              </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
              <div class="accordion-body">

                <form id="formFoto" action="../actions/clientes/atualizar_foto.php" method="POST" enctype="multipart/form-data">
                  <div style="display: flex; flex-direction: column; gap: 8px;">

                    <!-- input escondido -->
                    <input type="file" name="foto" id="inputFoto" accept="image/*" hidden>

                    <div class="d-grid gap-2">
                      <button type="button" onclick="abrirSeletor()" class="btn btn-outline-dark">Alterar foto de perfil</button>
                    </div>

                    <div class="d-grid gap-2">
                      <a type="button" href="../seguranca.php" target="_parent" class="btn btn-outline-dark text-dark">Minha Conta</a>
                    </div>

                    <div class="d-grid gap-2">
                      <a type="button" href="../actions/clientes/sair.php" target="_parent" class="btn btn-outline-dark text-dark">Telefones</a>
                    </div>

                    <div class="d-grid gap-2">
                      <a type="button" href="../enderecos.php" target="_parent" class="btn btn-outline-dark">Endereços</a>
                    </div>

                  </div>
                </form>
              </div>
            </div>
          </div>
          <div class="accordion-item">

            <h2 class="accordion-header" id="headingTwo">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                Gerenciar a Loja
              </button>
            </h2>

            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
              <div class="accordion-body">

                <div style="display: flex; flex-direction: column; gap: 8px;">

                  <div class="d-grid gap-2">
                    <a type="button" href="../enderecos.php" target="_parent" class="btn btn-outline-dark">Abertura e Fechamento</a>
                  </div>

                  <div class="d-grid gap-2">
                    <a type="button" href="../enderecos.php" target="_parent" class="btn btn-outline-dark">Gerenciar Promocoes</a>
                  </div>

                  <div class="d-grid gap-2">
                    <a type="button" href="../enderecos.php" target="_parent" class="btn btn-outline-dark">Gerenciar Cupons</a>
                  </div>

                  <div class="d-grid gap-2">
                    <a type="button" href="../enderecos.php" target="_parent" class="btn btn-outline-dark">Gerenciar Estetica do Site</a>
                  </div>

                  <div class="d-grid gap-2">
                    <a type="button" href="../enderecos.php" target="_parent" class="btn btn-outline-dark">Gerenciar Cargos</a>
                  </div>

                  <div class="d-grid gap-2">
                    <a type="button" href="../enderecos.php" target="_parent" class="btn btn-outline-dark">Gerenciar Carrossel</a>
                  </div>

                  <div class="d-grid gap-2">
                    <a type="button" href="../enderecos.php" target="_parent" class="btn btn-outline-dark">Gerenciar Comentarios</a>
                  </div>

                </div>

              </div>
            </div>
          </div>

          <div class="accordion-item">

            <h2 class="accordion-header" id="headingThree">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                Gerenciar Clientes
              </button>
            </h2>

            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
              <div class="accordion-body">
                <div style="display: flex; flex-direction: column; gap: 8px;">
                  <div class="d-grid gap-2">
                    <a type="button" href="../enderecos.php" target="_parent" class="btn btn-outline-dark">Registros de Login</a>
                  </div>

                  <div class="d-grid gap-2">
                    <a type="button" href="../enderecos.php" target="_parent" class="btn btn-outline-dark">Registros de Compras</a>
                  </div>

                  <div class="d-grid gap-2">
                    <a type="button" href="../enderecos.php" target="_parent" class="btn btn-outline-dark">Carrinhos</a>
                  </div>

                   <div class="d-grid gap-2">
                    <a type="button" href="../enderecos.php" target="_parent" class="btn btn-outline-dark">Gerenciar Perfil</a>
                  </div>

                   <div class="d-grid gap-2">
                    <a type="button" href="../enderecos.php" target="_parent" class="btn btn-outline-dark">Gerenciar Telefones</a>
                  </div>

                   <div class="d-grid gap-2">
                    <a type="button" href="../enderecos.php" target="_parent" class="btn btn-outline-dark">Gerenciar Endereços</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- fim do acordion -->

        <div style="display: flex; flex-direction: column; height: 30px;"> </div>

        <a href="../actions/funcionarios/sair_funcionarios.php" class="btn btn-danger text-white"> <i class="bi bi-box-arrow-left"></i> Sair
        </a>

      </div>
    </div>
  </div>
  </div>

  <?php include_once("../includes/bootstrap_include.php");
  include('../includes/sweet_alert2_include.php'); ?>
  <script>
    function abrirSeletor() {
      document.getElementById('inputFoto').click();
    }

    document.getElementById('inputFoto').addEventListener('change', function() {
      if (this.files.length > 0) {
        document.getElementById('formFoto').submit();
      }
    });
  </script>
</body>

</html>