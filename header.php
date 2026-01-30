<?php
session_start();
?>

<link rel="stylesheet" href="../projeto_lanches/css/header.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=menu" />

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
          <h2>Bem-vindo, <?php echo $_SESSION['usuario']['nome']; ?>!</h2>
          
          

        </div>
      <?php endif; ?>

    </div>
  </div>
</header>