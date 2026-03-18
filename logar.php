<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Tasty Burger</title>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/login.css">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body>
    <div class="login-wrapper">
        <h1 class="brand-name">Tasty Burger</h1>
        
        <div class="login-box">
            <h2 class="login-header">Login</h2>
            
            <form action="./actions/funcionarios/logar_funcionarios.php" method="POST">
                <div class="input-group">
                    <label>Email:</label>
                    <input type="email" name="email" required>
                </div>
                
                <div class="input-group">
                    <label>Senha:</label>
                    <input type="password" name="senha" required>
                </div>
                
                <div class="captcha-box">
                    <div class="g-recaptcha" data-sitekey="6LfOn3csAAAAAHV9Lm0HQia3ZfqKu4jEuiqKfans"></div>
                </div>
                
                <button type="submit" class="btn-submit">Entrar</button>
            </form>
            <a class="link" href="cadastrar.php">não tem uma conta? crie uma</a>
        </div>
    </div>
    <?php include_once('./includes/sweet_alert2_include.php'); ?>
</body>
</html>