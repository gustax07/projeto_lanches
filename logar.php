<?php

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./admin/css/logar.css">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <title>Login</title>
</head>
<body>
    
<h1 class="brand-text">Tasty Burger</h1>
<div class="login-container">
    <div class="login-card">
        <h1>Login</h1>
        <p class="subtitle">Área administrativa</p>

        <form action="../actions/funcionarios/logar_funcionarios.php" method="post">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" placeholder="exemplo@gmail.com" required>

            <label for="senha">Senha:</label>
            <input type="password" name="senha" id="senha" placeholder="*********" required>

            <button type="submit">Entrar</button>
        </form>

        <?php
            include_once("./includes/sweet_alert2_include.php");
        ?>
    </div>
</div>

</body>
</html>     