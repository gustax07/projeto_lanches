<?php


?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="./images/icon_burguer.png">
    <title>Lanches</title>
    <style>
        body {
            margin: 0px;
            border: none;
            padding: 0px;
            overflow: hidden;
        }
    </style>
</head>

<body>
    <div class="topo" style="position: fixed; width: 100%;">
    <!-- iframe do header -->
    <iframe src="./header.php"
        style="width: 100%; height: 155px; margin: 0; border: none;">
    </iframe>
    <!-- iframe do nav -->
    <iframe src="./nav.php"
        style="width: 100%; height: 60px; margin: 0; border: none;">
    </iframe>
    </div>
    <!-- iframe do corpo -->
    <iframe src="./lanches.php"
        style="width: 100%; height: 100vh; margin: 0; border: none; padding: 0;">
    </iframe>
    
</body>

</html>