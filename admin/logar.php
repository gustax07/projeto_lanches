<?php

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    <form action="../actions/funcionarios/logar_funcionarios.php" method="post">
    <label for="email">Email:</label>
    <br>
    <input type="email" name="email" id="email">
    <br>
    <label for="senha">Senha:</label>
    <br>
    <input type="password" name="senha" id="senha">
    <br>
    <button type="submit">Entrar</button>
    </form>
</body>
</html>