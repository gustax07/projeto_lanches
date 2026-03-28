<?php

//function que permiti fazer verificacoes de method request foram feitos via post
class restrict{
function verificarMethodRequest($caminhoPagina){
    if ($_SERVER['REQUEST_METHOD'] !== 'POST'){
        header('Location:'. $caminhoPagina);
        header('Cache-Control: no-cache, no-store, must-revalidate');
        header('Pragma: no-cache');
        header('Expires: 0');
        exit();
    }
}
}
?>