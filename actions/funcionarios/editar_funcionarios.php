<?php
print_r($_POST);
if(isset($_SERVER['REQUEST_METHOD']) == 'POST'){
    require_once('../../classes/funcionarios.class.php');
    $funcionarios = new Funcionarios();
    if ($_POST['nome'] == '') {
        echo "O nome não pode ser vazio.";
        exit;
    }elseif ($_POST['email'] == '') {
        echo "O email não pode ser vazio.";
        exit;
    }elseif ($_POST['data_contratacao'] == '') {
        echo "A data de contratação não pode ser vazia.";
        exit;
    }elseif ($_POST['id_cargos_fk'] == '') {
        echo "O cargo não pode ser vazio.";
        exit;
    }
    $funcionarios->id = $_GET['id'];
    $funcionarios->nome = $_POST['nome'];
    $funcionarios->email = $_POST['email'];
    $funcionarios->data_contratacao = $_POST['data_contratacao'];
    $funcionarios->id_cargos_fk = $_POST['id_cargos_fk'];
    $funcionarios->Editar();
    header('Location: ../../admin/gerenciar_funcionarios.php');
}

?>