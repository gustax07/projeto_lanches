<?php include('./header.php'); ?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/png" href="./images/icon_burguer.png">
  <link rel="stylesheet" href="css/cadastro.css">
  <title>Cadastro</title>
</head>
<body>
  
<div class="d-flex justify-content-center mt-5">
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