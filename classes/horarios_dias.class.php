<?php

require_once('banco.class.php');

class HorarioDias{
    public $id;
    public $dia_semana;
    public $horario_inicio;
    public $horario_fim;

    public function Listar(){
        $sql = "SELECT * FROM horarios_dias";
        $banco = Banco::conectar();
        $comando = $banco->prepare($sql);
        $comando->execute();
        $arr_resultado = $comando->fetchAll(PDO::FETCH_ASSOC);
        Banco::desconectar();
        return $arr_resultado;
    }

    public function Editar(){
        $sql = "UPDATE horarios_dias SET horario_inicio = ?, horario_fim = ? WHERE id = ?";
        $banco = Banco::conectar();
        $comando = $banco->prepare($sql);
        $comando->execute([
            $this->horario_inicio, 
            $this->horario_fim, 
            $this->id
            ]);
        Banco::desconectar();
        return $comando->rowCount();
    }
}
?>