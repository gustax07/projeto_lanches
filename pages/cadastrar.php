<link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
<link rel="stylesheet" href="css/login.css">
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<title>Cadastrar nova Conta</title>
<div class="login">
  <div class="header-backgroud"></div>
  <div class="container d-flex justify-content-center align-items-center mb-5">
    <div class="login-wrapper">

      <div class="login-box">
        <h2 class="login-header">Criar Conta</h2>

        <form method="post" action="./actions/clientes/cadastrar_clientes.php">

          <div class="group">
            <label>Nome completo</label>
            <input type="text" name="nome" id="nome" placeholder="Seu nome completo" required>
          </div>

          <div class="group">
            <label>Email</label>
            <input type="email" name="email" id="email" placeholder="seu@email.com" required>
          </div>

          <div class="group">
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
  </div>
</div>