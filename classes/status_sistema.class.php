<?php

require_once('banco.class.php');

class StatusSistema{
    private $id;
    private $status;

    public function Listar(){
        $sql = "SELECT * FROM status_sistema";
        $banco = Banco::conectar();
        $comando = $banco->prepare($sql);
        $comando->execute();
        $arr_resultado = $comando->fetchAll(PDO::FETCH_ASSOC);
        Banco::desconectar();
        return $arr_resultado;
    }
}


?>