<?php

require_once('../../classes/funcionarios.class.php');
print_r($_POST);
$funcionarios = new funcionarios();
$funcionarios->nome = $_POST['nome'];
$funcionarios->email = $_POST['email'];
$funcionarios->senha = $_POST['senha'];
$funcionarios->id_cargos_fk = $_POST['id_cargos'];
$funcionarios->data_contratacao = $_POST['data_contratacao'];

if ($funcionarios->nome == ''){
    echo "nome nao pode ser vazio";
}elseif($funcionarios->email == ''){
    echo "email nao pode ser vazio";
}elseif($funcionarios->senha == ''){
    echo "senha nao pode ser vazio";
}elseif($funcionarios->Cadastrar()){
    header('Location: ../../admin/painel.php');
}else{
    echo "erro ao cadastrar";
}

?>