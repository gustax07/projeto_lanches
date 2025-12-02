<?php

require_once('Banco.class.php');

class Cargos{
    public $id;
    public $nome_cargo;

    public function Listar(){
        $sql = "SELECT * FROM cargos";
        $banco = Banco::conectar();
        $comando = $banco->prepare($sql);
        $comando->execute();
        $arr_resultado = $comando->fetchAll(PDO::FETCH_ASSOC);
        Banco::desconectar();
        return $arr_resultado;
    }
}

?>