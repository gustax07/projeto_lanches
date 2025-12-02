<?php

require_once('../../classes/funcionarios.class.php');
print_r($_POST);

$funcionarios = new funcionarios();
$funcionarios->email = $_POST['email'];
$funcionarios->senha = $_POST['senha'];

if($funcionarios->email == "" && $funcionarios->senha == ""){
    echo "email ou senha não podem ser vazios";
}elseif($funcionarios->Logar()){
    header('Location: ../../admin/painel.php');
}else{
    echo "email ou senha incorretos";
}

?>