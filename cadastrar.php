<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/png" href="./images/icon_burguer.png">
  <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/login.css">
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  <title>Cadastro - Tasty Burger</title>
</head>

<body>

  <div class="login-wrapper">
    <h1 class="brand-name">Tasty Burger</h1>

    <div class="login-box">
      <h2 class="login-header">Criar Conta</h2>

      <form method="post" action="./actions/clientes/cadastrar_clientes.php">

        <div class="input-group">
          <label>Nome completo</label>
          <input type="text" name="nome" id="nome" placeholder="Seu nome completo" required>
        </div>

        <div class="input-group">
          <label>Email</label>
          <input type="email" name="email" id="email" placeholder="seu@email.com" required>
        </div>

        <div class="input-group">
          <label>Senha</label>
          <input type="password" name="senha" id="senha" placeholder="••••••••" required>
        </div>

        <div class="captcha-box">
                    <div class="g-recaptcha" data-sitekey="6LfOn3csAAAAAHV9Lm0HQia3ZfqKu4jEuiqKfans"></div>
                </div>

        <button type="submit" class="btn-submit">Cadastrar</button>
      </form>
    </div>
  </div>
</body>

</html>