<?php
include_once('./includes/bootstrap_include.php');

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="./images/icon_burguer.png">
    <title>Tasty Burguer - home</title>
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
    <div class="fixed-top" style="position: fixed; width: 100%; padding: 0px; ">
        <!-- iframe do header -->
        <iframe src="./header.php" frameborder="0" scrolling="no" id="headerIframe"
            style="width: 100%; height: 155px; margin: 0; border: none; padding: 0 ; overflow: hidden;">
        </iframe>
        <!-- iframe do nav -->
        <iframe src="./nav.php"
            style="width: 100%; height: 72px; margin: 0; border: none; border-radius: 0 0 50% 50%; overflow: hidden;">
        </iframe>
    </div>
    <!-- iframe do corpo -->
    <iframe src="./lanches.php" id="corpoIframe"
        style="width: 100vw; height: 100vh; margin: 0; border: none; padding: 0;">
    </iframe>


</body>

</html>