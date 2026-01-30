<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <title>Cadastro</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      background-color: #FFF6E8;
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .card-cadastro {
      width: 100%;
      max-width: 400px;
      border-radius: 16px;
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    }

    .btn-principal {
      background-color: #FFC781;
      border: none;
      color: #000;
      font-weight: 600;
    }

    .btn-principal:hover {
      background-color: #f5b968;
    }

    .titulo {
      color: #000;
      font-weight: 700;
    }
  </style>
</head>

<body>

  <div class="card card-cadastro p-4">
    <h3 class="text-center titulo mb-4">Criar conta</h3>

    <form method="post" action="./actions/clientes/cadastrar_clientes.php" target="conteudo">

      <div class="mb-3">
        <label class="form-label">Nome completo</label>
        <input
          type="text"
          name="nome"
          id="nome"
          class="form-control"
          placeholder="Seu nome completo"
          required>
      </div>

      <div class="mb-3">
        <label class="form-label">Email</label>
        <input
          type="email"
          name="email"
          id="email"
          class="form-control"
          placeholder="seu@email.com"
          required>
      </div>

      <div class="mb-4">
        <label class="form-label">Senha</label>
        <input
          type="password"
          name="senha"
          id="senha"
          class="form-control"
          placeholder="••••••••"
          required>
      </div>

      <button type="submit" class="btn btn-principal w-100">
        Entrar
      </button>

    </form>


  </div>

</body>

</html>