<?php

require_once('Banco.class.php');

class Categorias{
    public $id;
    public $nome;
     //listar categorias
    public function Listar(){
        $sql = "SELECT * FROM categorias";
        $banco = Banco::conectar();
        $comando = $banco->prepare($sql);
        $comando->execute();
        $arr_resultado = $comando->fetchAll(PDO::FETCH_ASSOC);
        Banco::desconectar();
        return $arr_resultado;
    }

    //adicionar categorias
    public function Cadastrar(){
        $sql = "INSERT INTO categorias (nome) 
        VALUES (?)";
        $banco = Banco::conectar();
        $comando = $banco->prepare($sql);
        $comando->execute([
            $this->nome
        ]);
        Banco::desconectar();
        return $comando->rowCount();
    }

    //editar categorias
    public function Editar(){
        $sql = "UPDATE categorias SET nome = ? WHERE id = ?";
        $banco = Banco::conectar();
        $comando = $banco->prepare($sql);
        $comando->execute([
            $this->nome,
            $this->id
        ]);
        Banco::desconectar();
        return $comando->rowCount();
    }

    //excluir categorias
    public function Excluir(){
        $sql = "DELETE FROM categorias WHERE id = ?";
        $banco = Banco::conectar();
        $comando = $banco->prepare($sql);
        $comando->execute([
            $this->id
        ]);
        Banco::desconectar();
        return $comando->rowCount();
    }
}

?>