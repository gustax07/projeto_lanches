<?php

require_once('../../classes/usuarios.class.php');

$foto = $_FILES['foto'];

/* Pega a extensão da imagem */
$extensao = pathinfo($foto['name'], PATHINFO_EXTENSION);

/* Cria um nome novo para a foto */
$nomeFoto = 'item_' . $_POST['usuario']['id'] . '.' . $extensao;

$pasta = '../../images/';

move_uploaded_file($foto['tmp_name'], $pasta . $nomeFoto);

?>