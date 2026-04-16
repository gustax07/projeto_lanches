<?php

if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
include_once("includes/bootstrap_include.php");
include_once('includes/sweet_alert2_include.php')

?>

<link rel="stylesheet" href="css/header.css">
<script src="js/header.js" defer></script>
<style>
  .alert {
    font-size: 14px !important;
    padding: 2px 4px !important;
  }
</style>


<div class="header">
<div class="site-header">
  <div class="container">

    <div class="header-content">

      <!-- Logo/Título centralizado -->
      <h1 class="logo-title">
        <a href="/projeto_lanches/">Tasty Burguer</a>
      </h1>
      <div class="col d-flex align-items-end mx-3 mt-2">
        <div id="status">
          <div class="spinner-border" role="status">
            <span class="visually-hidden">Loading...</span>
          </div>
        </div>
      </div>
      <div class="header-center"></div>
      <?php if (!isset($_SESSION['usuario'])): ?>
        <!-- Botões direita (NÂO LOGADO) -->
        <div class="header-buttons">
          <a href="logar.php" target="_parent" class="btn-login">Logar</a>
          <a href="cadastrar.php" target="_parent" class="btn-register">Cadastre-se</a>
        </div>

      <?php else: ?>
       
        <?php if ($_SESSION['usuario']['id_tipo_fk'] == 6): ?>
        <a class="btn btn-warning text-white me-3" href="admin" target="_blank">Dashboard</a>
        <?php endif; ?>

        <!-- Botões direita (LOGADO) -->
        <div class="header-buttons">
          <h3 class="user-greeting">Bem-vindo, <strong><?= $_SESSION['usuario']['nome']; ?>!</strong></h3>

          <?php
          $foto = !empty($_SESSION['usuario']['foto'])
            ? 'images/' . $_SESSION['usuario']['foto']
            : 'images/foto_perfil_default.png';
          ?>

          <button data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample" class="btn rounded-circle profile-btn-header" type="button">
            <img src="<?= $foto ?>" alt="Foto do usuário" class="rounded-circle" />
          </button>

          <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
            <div class="offcanvas-header">
              <h5 class="offcanvas-title" id="offcanvasExampleLabel">Meu perfil</h5>
              <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>

            <div class="offcanvas-body">
              <div>
                <!-- setar uma foto padrão se a foto for vazia, se não for, pegar a foto do banco -->
                <?php
                $foto = !empty($_SESSION['usuario']['foto'])
                  ? 'images/' . $_SESSION['usuario']['foto']
                  : 'images/foto_perfil_default.png';

                ?>

                <div class="perfil-offcanvas">
                  <img src="<?= $foto ?>" alt="Foto do usuário">

                  <h3><?= $_SESSION['usuario']['nome'] ?></h3>
                  <p><?= $_SESSION['usuario']['email'] ?></p>
                </div>
                <!-- começo do acordion -->
                <div class="accordion" id="accordionExample">
                  <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                      <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                        configurações de conta
                      </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                      <div class="accordion-body">

                        <form id="formFoto" action="actions/clientes/atualizar_foto.php" method="POST" enctype="multipart/form-data">
                          <div style="display: flex; flex-direction: column; gap: 8px;">

                            <!-- input escondido -->
                            <input type="file" name="foto" id="inputFoto" accept="image/*" hidden>

                            <div class="d-grid gap-2">
                              <button type="button" onclick="abrirSeletor()" class="btn btn-outline-dark">Alterar foto de perfil</button>
                            </div>

                            <div class="d-grid gap-2">
                              <a href="conta.php" class="btn btn-outline-dark">Minha Conta</a>
                            </div>
                            <div class="d-grid gap-2">
                              <a href="telefones.php" class="btn btn-outline-dark">Meus Telefones</a>
                            </div>

                          </div>
                        </form>
                      </div>
                    </div>
                  </div>

                  <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTwo">
                      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        endereços
                      </button>
                    </h2>

                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                      <div class="accordion-body">

                        <div style="display: flex; flex-direction: column; gap: 8px;">
                          <div class="d-grid gap-2">
                            <a type="button" href="enderecos.php" class="btn btn-outline-dark">Endereços</a>
                          </div>
                        </div>

                      </div>
                    </div>
                  </div>

                  <div class="accordion-item">
                    <h2 class="accordion-header" id="headingThree">
                      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapsehree">
                        Pedidos
                      </button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                      <div class="accordion-body">

                        <div style="display: flex; flex-direction: column; gap: 8px;">
                          <div class="d-grid gap-2">
                            <a type="button" href="meus_pedidos.php" class="btn btn-outline-dark">ver meus pedidos </a>
                          </div>
                        </div>

                      </div>
                    </div>
                  </div>
                </div>
                <!-- fim do acordion -->

                <div style="display: flex; flex-direction: column; height: 30px;"> </div>

                <a href="actions/clientes/deslogar.php" class="btn btn-danger"> <i class="bi bi-box-arrow-left"></i> Sair
                </a>

              </div>
            </div>
          </div>
        </div>

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

      <?php endif; ?>
    </div>
  </div>
</div>
</div>