
<?php
  include('includes/bootstrap_include.php');
  ?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <title>Cadastro</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/png" href="./images/icon_burguer.png">

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      background-color: #FFF6E8;
    }

    .card-cadastro {
      width: 100vw;
      max-width: 400px;
      border-radius: 16px;
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    }

    .btn-principal {
      background-color: #FFC781;
      border: none;
      color: #000;
      font-weight: 600;
      transition: all 0.3s ease;
      border-radius: 8px;
      padding: 8px 16px;
    }

    .btn-principal:hover {
      background-color: #f5b968;
      transform: scale(1.05);
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    }

    .titulo {
      color: #000;
      font-weight: 700;
    }

    .form-control:hover {
      border-color: #FFC781;
    }
  </style>
</head>

<body>

  

<div class="d-flex justify-content-center align-items-center vh-100">
  <div class="container-fluid card card-cadastro mb-5 p-4">
    <h3 class="text-center titulo mb-4">Criar conta</h3>

    <form method="post" action="./actions/clientes/cadastrar_clientes.php" target="conteudo">

      <div class="mb-3">
        <label class="form-label">Nome completo</label>
        <input type="text" name="nome" id="nome" class="form-control focus-ring focus-ring-warning border-warning" placeholder="Seu nome completo" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" name="email" id="email" class="form-control focus-ring focus-ring-warning border-warning" placeholder="seu@email.com" required>
      </div>

      <div class="mb-4">
        <label class="form-label">Senha</label>
        <input type="password" name="senha" id="senha" class="form-control focus-ring focus-ring-warning border-warning" placeholder="••••••••" required>
      </div>

      <button type="submit" class="btn-principal w-100">Entrar</button>
    </form>
  </div>
</div>
</body>

</html>