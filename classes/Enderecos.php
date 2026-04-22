<?php

namespace App;
use PDO;


class Enderecos extends Banco
{
    public $id;
    public $id_usuarios_fk;
    public $rua;
    public $numero;
    public $bairro;
    public $cidade;
    public $estado;
    public $cep;

    // listar enderecos
    public function Listar()
    {
        $sql = "SELECT * FROM enderecos";
        
        $comando = self::conectar()->prepare($sql);
        $comando->execute();
        $arr_resultado = $comando->fetchAll(PDO::FETCH_ASSOC);
        
        return $arr_resultado;
    }

    //listar enderecos por id do usuário
    public function ListarPorID()
    {
        $sql = "SELECT * FROM enderecos WHERE id_usuarios_fk = ?";
        
        $comando = self::conectar()->prepare($sql);
        $comando->execute([
            $this-> id_usuarios_fk
        ]);
        $arr_resultado = $comando->fetchAll(PDO::FETCH_ASSOC);
        
        return $arr_resultado;
    }

    public function BuscarPorId($idEndereco, $idUsuario)
    {
        $sql = "SELECT * FROM enderecos 
            WHERE id = ? AND id_usuarios_fk = ?";
        
        $comando = self::conectar()->prepare($sql);
        $comando->execute([
            $idEndereco,
            $idUsuario
        ]);
        $arr_resultado = $comando->fetchAll(PDO::FETCH_ASSOC);
        
        return $arr_resultado;
    }

    //cadastrar um novo endereco
    public function Cadastrar()
    {
        $sql = "INSERT INTO enderecos (id_usuarios_fk, rua, numero, bairro, cidade, estado, cep) VALUES (?, ?, ?, ?, ?, ?, ?)";
        
        $comando = self::conectar()->prepare($sql);
        $comando->execute([
            $this->id_usuarios_fk,
            $this->rua,
            $this->numero,
            $this->bairro,
            $this->cidade,
            $this->estado,
            $this->cep
        ]);
        
        return $comando->rowCount();
    }

    //editar um endereco
    public function Editar()
    {
        $sql = "UPDATE enderecos SET rua = ?, numero = ?, bairro = ?, cidade = ?, estado = ?, cep = ? WHERE id = ?";
        
        $comando = self::conectar()->prepare($sql);
        $comando->execute([
            $this->rua,
            $this->numero,
            $this->bairro,
            $this->cidade,
            $this->estado,
            $this->cep,
            $this->id
        ]);
        
        return $comando->rowCount();
    }

    //excluir um endereco
    public function Excluir()
    {
        $sql = "DELETE FROM enderecos WHERE id = ?";
        
        $comando = self::conectar()->prepare($sql);
        $comando->execute([
            $this->id
        ]);
        
        return $comando->rowCount();
    }
}
