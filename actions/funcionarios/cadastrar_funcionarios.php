<?php

require_once('../../classes/usuarios.class.php');
print_r($_POST);
$funcionarios = new Usuarios();
$funcionarios->nome = $_POST['nome'];
$funcionarios->email = $_POST['email'];
$funcionarios->senha = $_POST['senha'];
$funcionarios->id_tipo_fk = $_POST['id_tipo_fk'];
$funcionarios->data_cadastro = date('Y-m-d');

if ($funcionarios->nome == ''){
    echo "nome nao pode ser vazio";
}elseif($funcionarios->email == ''){
    echo "email nao pode ser vazio";
}elseif($funcionarios->senha == ''){
    echo "senha nao pode ser vazio";
}elseif($funcionarios->Cadastrar()){
    header('Location: ../../admin/gerenciar_funcionarios.php?msg=funcionario_cadastrado&id_tipo_fk=-1');
}else{
    header('Location: ../../admin/gerenciar_funcionarios.php?err=funcionario_cadastro_falha');
}

?>