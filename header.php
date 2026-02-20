<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include_once("./includes/bootstrap_include.php");

?>

<link rel="stylesheet" href="css/header.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@40,400,0,0" />

<style>
  .material-symbols-outlined {
    font-variation-settings:
      'FILL' 0,
      'wght' 400,
      'GRAD' 0,
      'opsz' 48
  }

  .btn-menu {
    color: inherit;
    text-decoration: none;
    cursor: pointer;
  }

  .menu-icon {
    font-size: 42px;
    cursor: pointer;
  }

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
</style>

<header class="site-header">
  <div class="container">
    <div class="header-content">

      <!-- Logo/Título centralizado -->
      <h1 class="logo-title">
        <a href="../projeto_lanches/header.php">Tasty Burguer</a>
      </h1>

      <?php if (!isset($_SESSION['usuario'])): ?>
        <!-- Botões direita (NÂO LOGADO) -->
        <div class="header-buttons">
          <a href="./logar.php" target="_parent" class="btn-login">Logar</a>
          <a href="./cadastrar.php" target="_parent" class="btn-register">Cadastre-se</a>
        </div>

      <?php else: ?>

        <!-- Botões direita (LOGADO) -->
        <div class="header-buttons">
          <h2 style="font-family: 'Poppins', 'Segoe UI', sans-serif;">Bem-vindo, <?php echo $_SESSION['usuario']['nome']; ?>!</h2>

          <!-- Botão menu que abre o offcanvas -->
          <a
          
            data-bs-toggle="offcanvas"
            href="#offcanvasExample"
            role="button"
            aria-controls="offcanvasExample"
            style="text-decoration: none; color: inherit;">
            <span class="material-symbols-outlined menu-icon">
              menu
            </span>
          </a>


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
                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                      <div class="accordion-body">

                        <form id="formFoto" action="actions/clientes/atualizar_foto.php" method="POST" enctype="multipart/form-data">
                          <div style="display: flex; flex-direction: column; gap: 8px;">

                            <!-- input escondido -->
                            <input
                              type="file"
                              name="foto"
                              id="inputFoto"
                              accept="image/*"
                              hidden>


                            <div class="d-grid gap-2">
                              <button type="button" onclick="abrirSeletor()" class="btn btn-outline-dark">Alterar foto de perfil</button>
                            </div>


                            <div class="d-grid gap-2">
                              <a type="button" href="seguranca.php" target="_parent" class="btn btn-outline-dark">minha conta</a>
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
                            <a type="button" href="enderecos.php" target="_parent" class="btn btn-outline-dark">ver endereços cadastrados</a>
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
</header>