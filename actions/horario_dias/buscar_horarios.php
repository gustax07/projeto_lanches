<?php
require_once __DIR__ . '/../../vendor/autoload.php';
use App\HorarioDias;
$horarios_dias = new HorarioDias();

$listar = $horarios_dias->Listar();
header('Content-Type: application/json');
echo json_encode($listar); 