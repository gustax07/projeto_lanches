<?php

namespace App;
use PDO;

class Telefones extends Banco
{
    public $id;
    public $id_usuarios_fk;
    public $numero;
    public $ddi;
    //listar numeros
    public function Listar() {
        $sql = "SELECT * FROM telefones";
        
        $comando = self::conectar()->prepare($sql);
        $comando->execute();
        $arr_resultado = $comando->fetchAll(PDO::FETCH_ASSOC);
        
        return $arr_resultado;
    }

    //listar numeros por id com innerjoin com o usuario
    public function ListarPorID() {
        $sql = "SELECT * FROM telefones WHERE id_usuarios_fk = ?";
        
        $comando = self::conectar()->prepare($sql);
        $comando->execute([
            $this->id_usuarios_fk
        ]);
        $arr_resultado = $comando->fetchAll(PDO::FETCH_ASSOC);
        
        return $arr_resultado;
    }

    //cadastrar o numero
    public function Cadastrar() {
        $sql = "INSERT INTO telefones (id_usuarios_fk, numero, ddi) VALUES (?, ?, ?)";
        
        $comando = self::conectar()->prepare($sql);
        $comando->execute([
            $this->id_usuarios_fk,
            $this->numero,
            $this->ddi
        ]);
        
        return $comando->rowCount();
    }

    //editar o numero
    public function Editar() {
        $sql = "UPDATE telefones SET DDI = ?, numero = ? WHERE id = ?";
        
        $comando = self::conectar()->prepare($sql);
        $comando->execute([
            $this->ddi,
            $this->numero,
            $this->id
        ]);
        
        return $comando->rowCount();
    }

    //excluir o numero
    public function Excluir() {
        $sql = "DELETE FROM telefones WHERE id = ?";
        
        $comando = self::conectar()->prepare($sql);
        $comando->execute([
            $this->id
        ]);
        
        return $comando->rowCount();
    }
}

?>