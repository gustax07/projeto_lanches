<?php

namespace App;
use PDO;

class HorarioDias extends Banco{
    public $id;
    public $dia_semana;
    public $horario_inicio;
    public $horario_fim;

    public function Listar(){
        $sql = "SELECT * FROM horarios_dias";
        
        $comando = self::conectar()->prepare($sql);
        $comando->execute();
        $arr_resultado = $comando->fetchAll(PDO::FETCH_ASSOC);
        
        return $arr_resultado;
    }

    public function Editar(){
        $sql = "UPDATE horarios_dias SET horario_inicio = ?, horario_fim = ? WHERE id = ?";
        
        $comando = self::conectar()->prepare($sql);
        $comando->execute([
            $this->horario_inicio, 
            $this->horario_fim, 
            $this->id
            ]);
        
        return $comando->rowCount();
    }
}
?>