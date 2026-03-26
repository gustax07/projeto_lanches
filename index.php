<!DOCTYPE html>
<html lang="pt-BR">
<?php include("includes/sweet_alert2_include.php"); ?>

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
        
    <div style="position: fixed; top: 0; left: 0; width: 100%; z-index: 1050;">
    <?php include('./header.php');  include('./nav.php'); ?>
</div>
      
<div style="padding-top: 100px;">
    <div id="conteudo-principal"> <?php include('./lanches.php'); ?> </div>
    <?php include('./footer.php'); ?>
</div>
</body>

</html>