
<html lang="pt-BR">
<?php include("includes/sweet_alert2_include.php"); ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="images/icon_burguer.png">
    <link rel="stylesheet" href="css/lanches.css">
    <link rel="stylesheet" href="css/pedido.css">
    <script src="js/router.js" defer></script>
    <title>Tasty Burguer - home</title>
    <style>
        body {
            margin: 0px;
            padding: 0px;
            border: none;
        }
    </style>
</head>

<body>
  <?php
$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$pastaProjeto = ($_SERVER['HTTP_HOST'] == 'localhost') ? '/projeto_lanches' : '/';
if (strpos($url, $pastaProjeto) === 0) {
    $url = substr($url, strlen($pastaProjeto));
}
if ($url === '') {
    $url = '/';
}

$rotas = require('rotas.php');

$isAjax = isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest';

if (!$isAjax) {
    require_once('components/toggler.php');
  
    echo '<div id="root">';
}

if (array_key_exists($url, $rotas)) {
    require_once($rotas[$url]);
} else {
    echo '<h2>Erro 404: Página não encontrada!</h2>';
}

if (!$isAjax) {
    echo '</div>';
    require_once('components/footer.php');
}
?>
</body>