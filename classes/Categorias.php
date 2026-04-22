<?php

namespace App;
use PDO;


class Categorias extends Banco{
    public $id;
    public $nome;
     //listar categorias
    public function Listar(){
        $sql = "SELECT * FROM categorias";

        $comando = self::conectar()->prepare($sql);
        $comando->execute();
        return $comando->fetchAll(PDO::FETCH_ASSOC);
    }

    //adicionar categorias
    public function Cadastrar(){
        $sql = "INSERT INTO categorias (nome) 
        VALUES (?)";
        
        $comando = self::conectar()->prepare($sql);
        $comando->execute([
            $this->nome
        ]);
        
        return $comando->rowCount();
    }

    //editar categorias
    public function Editar(){
        $sql = "UPDATE categorias SET nome = ? WHERE id = ?";
        
        $comando = self::conectar()->prepare($sql);
        $comando->execute([
            $this->nome,
            $this->id
        ]);
        
        return $comando->rowCount();
    }

    //excluir categorias
    public function Excluir(){
        $sql = "DELETE FROM categorias WHERE id = ?";
        
        $comando = self::conectar()->prepare($sql);
        $comando->execute([
            $this->id
        ]);
        
        return $comando->rowCount();
    }
    public function PesquisarPorNome(){
        $sql = 'SELECT * FROM categorias WHERE nome = ?';
        
        $comando = self::conectar()->prepare($sql);
        $comando->execute([
            $this->nome
        ]);
        $arr_resultado = $comando->fetchAll(PDO::FETCH_ASSOC);
        
        return $arr_resultado;
    }

    //listar categiras com Innerjoin
    // public function ListarInnerJoin(){
    //     $sql = "SELECT * FROM categorias INNER JOIN itens ON categorias.id = itens.id_categoria_fk";
    //     
    //     $comando = self::conectar()->prepare($sql);
    //     $comando->execute();
    //     $arr_resultado = $comando->fetchAll(PDO::FETCH_ASSOC);
    //     
    //     return $arr_resultado;
    // }
}

?>