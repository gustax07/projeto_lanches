<?php

namespace App;
use PDO;

class Tipos extends Banco
{
    public $id;
    public $nome_tipo;

    public function Listar(){
        $sql = "SELECT * FROM tipos";
        
        $comando = self::conectar()->prepare($sql);
        $comando->execute();
        $arr_resultado = $comando->fetchAll(PDO::FETCH_ASSOC);
        
        return $arr_resultado;
    }
}

?>