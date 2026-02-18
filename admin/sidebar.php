<?php

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/painel.css">

    <title>Painel Administrador</title>
    <style>
        iframe {
            display: block;
        }
    </style>
</head>

<body>
    <nav class="navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="../images/icon_burguer.png" alt="Logo" width="30" height="24" class="d-inline-block align-text-top">
                Tasty Burger
            </a>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <a class="nav-link active" aria-current="page" href="index.php"> Pagina Inicial</a>
            <a class="nav-link active" aria-current="page" href="pedidos.php">Pedidos</a>
            </div>

        </div>
    </nav>
   
 
    <?php include_once("../includes/bootstrap_include.php"); ?>
        
</body>

</html>