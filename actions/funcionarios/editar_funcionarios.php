<?php
require_once __DIR__ . '/../../vendor/autoload.php';
use App\Usuarios;
$funcionarios = new Usuarios();

if (!isset($_SESSION)) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $id_tipo_fk = $_POST['id_tipo_fk'];

    if (empty($id) || empty($nome) || empty($email) || empty($id_tipo_fk)) {
        header('Location: ../../admin/gerenciar_funcionarios.php');
        exit;
    } else {

        $funcionarios->id = $id;
        $funcionarios->nome = $nome;
        $funcionarios->email = $email;
        $funcionarios->senha = $_POST['senha'];
        $funcionarios->id_tipo_fk = $id_tipo_fk;

        if ($funcionarios->Editar()) {
            header('Location: ../../admin/gerenciar_funcionarios.php?msg=funcionario_editado');
            exit();
        } else {
            header('Location: ../../admin/gerenciar_funcionarios.php?err=funcionario_editar_falha');
            exit();
        }
    }
}
?>