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
        padding: 0px;
        border: none;
        overflow: hidden;
    }
</style>
</head>

<body>
    <div class="sticky-top" >
        <?php include('./header.php'); ?>

        <?php include('./nav.php'); ?>
    </div>
    <!-- iframe do corpo -->
    <iframe src="lanches.php" id="corpoIframe" 
    style="width: 100%; height: calc(100vh - 180px); border: none;"> 
    </iframe>

    <script>
        function atualizarCorpo() {
            document.getElementById('corpoIframe').src =
                document.getElementById('corpoIframe').src;
        }



        window.addEventListener('message', function(event) {
    // Recebe a altura enviada pelo iframe e aplica ao elemento
    if (typeof event.data === 'number') {
        document.getElementById('corpoIframe').style.height = event.data + 'px';
    }
}, false);
    </script>

</body>

</html>