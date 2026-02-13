<?php

require_once("banco.class.php");

class Enderecos
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
        $banco = Banco::conectar();
        $comando = $banco->prepare($sql);
        $comando->execute();
        $arr_resultado = $comando->fetchAll(PDO::FETCH_ASSOC);
        Banco::desconectar();
        return $arr_resultado;
    }

    //listar enderecos por id do usuário
    public function ListarPorID($idusuario)
    {
        $sql = "SELECT * FROM enderecos WHERE id_usuarios_fk = ?";
        $banco = Banco::conectar();
        $comando = $banco->prepare($sql);
        $comando->execute([
            $idusuario
        ]);
        $arr_resultado = $comando->fetchAll(PDO::FETCH_ASSOC);
        Banco::desconectar();
        return $arr_resultado;
    }

    public function BuscarPorId($idEndereco, $idUsuario)
    {
        $sql = "SELECT * FROM enderecos 
            WHERE id = ? AND id_usuarios_fk = ?";
        $banco = Banco::conectar();
        $comando = $banco->prepare($sql);
        $comando->execute([
            $idEndereco,
            $idUsuario
        ]);
        $arr_resultado = $comando->fetchAll(PDO::FETCH_ASSOC);
        Banco::desconectar();
        return $arr_resultado;
    }

    //cadastrar um novo endereco
    public function Cadastrar()
    {
        $sql = "INSERT INTO enderecos (id_usuarios_fk, rua, numero, bairro, cidade, estado, cep) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $banco = Banco::conectar();
        $comando = $banco->prepare($sql);
        $comando->execute([
            $this->id_usuarios_fk,
            $this->rua,
            $this->numero,
            $this->bairro,
            $this->cidade,
            $this->estado,
            $this->cep
        ]);
        Banco::desconectar();
        return $comando->rowCount();
    }

    //editar um endereco
    public function Editar()
    {
        $sql = "UPDATE enderecos SET rua = ?, numero = ?, bairro = ?, cidade = ?, estado = ?, cep = ? WHERE id = ?";
        $banco = Banco::conectar();
        $comando = $banco->prepare($sql);
        $comando->execute([
            $this->rua,
            $this->numero,
            $this->bairro,
            $this->cidade,
            $this->estado,
            $this->cep,
            $this->id
        ]);
        Banco::desconectar();
        return $comando->rowCount();
    }

    //excluir um endereco
    public function Excluir()
    {
        $sql = "DELETE FROM enderecos WHERE id = ?";
        $banco = Banco::conectar();
        $comando = $banco->prepare($sql);
        $comando->execute([
            $this->id
        ]);
        Banco::desconectar();
        return $comando->rowCount();
    }
}
