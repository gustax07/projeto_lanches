<?php

require_once('Banco.class.php');

class Tipos{
    public $id;
    public $nome_tipo;

    public function Listar(){
        $sql = "SELECT * FROM tipos";
        $banco = Banco::conectar();
        $comando = $banco->prepare($sql);
        $comando->execute();
        $arr_resultado = $comando->fetchAll(PDO::FETCH_ASSOC);
        Banco::desconectar();
        return $arr_resultado;
    }
}

?>