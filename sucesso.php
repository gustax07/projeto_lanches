<?php
session_start();
if (!isset($_SESSION['usuario'])) {
  header('Location: logar.php');
  exit;
}
header('location: index.php?msg=pagamento_realizado');
?>