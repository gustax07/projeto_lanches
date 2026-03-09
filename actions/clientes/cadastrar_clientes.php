<?php

require_once('../../classes/usuarios.class.php');
print_r($_POST);
$clientes = new Usuarios();
$clientes->nome = strip_tags($_POST['nome']);
$clientes->email = strip_tags($_POST['email']);
$clientes->senha = strip_tags($_POST['senha']);
$clientes->data_cadastro = strip_tags(date('Y-m-d'));
$clientes->id_tipo_fk = 0;

if ($clientes->nome == ''){
    echo "nome nao pode ser vazio";
}elseif($clientes->email == ''){
    echo "email nao pode ser vazio";
}elseif($clientes->senha == ''){
    echo "senha nao pode ser vazio";
}elseif($clientes->Cadastrar()){
    header('Location: ../../index.php');
}else{
    header('Location: ../../cadastrar.php');
}

?>