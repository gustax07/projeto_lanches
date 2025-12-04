<?php

// session_start();
// if (!isset($_SESSION['funcionario'])) {
//     header('Location: ./logar.php');
//     exit();
// }

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Administrador</title>
</head>
<body>
<h1>Painel Administrador</h1>
<h2>Ola, Administrador</h2>
<button><a href="../actions/funcionarios/sair_funcionarios.php">Sair</a></button>
<h4>Painel de Controle</h4>
<button><a href="./gerenciar_funcionarios.php">Gerenciar Funcionarios</a></button>


</body>
</html>