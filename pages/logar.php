
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/login.css">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    
<div class="login">
    <div class="header-backgroud"></div>

    <div class="container d-flex justify-content-center align-items-center mb-5">
    <div class="login-wrapper">
        
        <div class="login-box">
            <h2 class="login-header">Login</h2>
            
            <form action="actions/funcionarios/logar_funcionarios.php" method="POST">
                <div class="group">
                    <label>Email:</label>
                    <input type="email" name="email" placeholder="seu@email.com" required>
                </div>
                
                <div class="group">
                    <label>Senha:</label>
                    <input type="password" name="senha" placeholder="********" required>
                </div>
                
                <div class="captcha-box">
                    <div class="g-recaptcha" data-sitekey="6LfOn3csAAAAAHV9Lm0HQia3ZfqKu4jEuiqKfans"></div>
                </div>
                
                <button type="submit" class="btn-submit">Entrar</button>
            </form>
            <a class="link" href="cadastrar.php">não tem uma conta? crie uma</a>
        </div>
    </div>
    </div>
</div>