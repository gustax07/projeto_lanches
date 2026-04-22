<html lang="pt-BR">
<?php include("includes/sweet_alert2_include.php"); ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="images/icon_burguer.png">
    <link rel="stylesheet" href="/css/lanches.css">
    <link rel="stylesheet" href="/css/pedido.css">
    <link rel="stylesheet" href="css/global.css">
    <script src="/js/router.js" defer></script>

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


    $pastaProjeto = '/projeto_lanches';
    if (strpos($url, $pastaProjeto) === 0) {
        $url = substr($url, strlen($pastaProjeto));
    }

    // 2. GARANTIA: Se a URL ficar vazia, vira home
    if ($url === '' || $url === null) {
        $url = '/';
    }

    $rotas = require('rotas.php');

    // 3. DETECÇÃO DE AJAX (Para o router.js funcionar)
    $isAjax = (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest');

    if (!$isAjax) {
        echo '<div style="position: fixed; top: 0; left: 0; width: 100%; z-index: 1050; ">';
        include('components/header.php');
        include('components/nav.html');
        echo '</div>';
        echo '<div id="root">';
    }

    // 4. O ROTEAMENTO REAL
    if (array_key_exists($url, $rotas)) {
        require_once($rotas[$url]);
    } else {
        header("HTTP/1.0 404 Not Found");
    }

    if (!$isAjax) {
        echo '</div>';
        require_once('components/footer.html');
    }
    ?>
</body>

</html>