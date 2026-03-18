<?php
require_once('../../classes/horarios_dias.class.php'); 

$horarios_dias = new HorarioDias();

$listar = $horarios_dias->Listar();
header('Content-Type: application/json');
echo json_encode($listar); 