<?php

require_once('../../classes/usuarios.class.php');
print_r($_POST);
$clientes = new Usuarios();
$clientes->nome = $_POST['nome'];
$clientes->email = $_POST['email'];
$clientes->senha = $_POST['senha'];
$clientes->data_cadastro = date('Y-m-d');
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