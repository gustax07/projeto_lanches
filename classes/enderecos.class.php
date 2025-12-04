<?php

require_once("banco.class.php");

class enderecos
{
    public $id;
    public $clientes_id;
    public $rua;
    public $numero;
    public $bairro;
    public $cidade;
    public $estado;
    public $cep;

    // listar enderecos
    public function Listar() {
        $sql = "SELECT * FROM enderecos";
        $banco = Banco::conectar();
        $comando = $banco->prepare($sql);
        $comando->execute();
        $arr_resultado = $comando->fetchAll(PDO::FETCH_ASSOC);
        Banco::desconectar();
        return $arr_resultado;
    }

    //listar enderecos com inner join com o cliente
    public function ListarInnerJoin() {
        $sql = "SELECT * FROM enderecos INNER JOIN clientes ON enderecos.clientes_id = clientes.id";
        $banco = Banco::conectar();
        $comando = $banco->prepare($sql);
        $comando->execute();
        $arr_resultado = $comando->fetchAll(PDO::FETCH_ASSOC);
        Banco::desconectar();
        return $arr_resultado;
    }

    //cadastrar um novo endereco
    public function Cadastrar() {
        $sql = "INSERT INTO enderecos (clientes_id, rua, numero, bairro, cidade, estado, cep) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $banco = Banco::conectar();
        $comando = $banco->prepare($sql);
        $comando->execute([
            $this->clientes_id,
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
    public function Editar() {
        $sql = "UPDATE enderecos SET clientes_id = ?, rua = ?, numero = ?, bairro = ?, cidade = ?, estado = ?, cep = ? WHERE id = ?";
        $banco = Banco::conectar();
        $comando = $banco->prepare($sql);
        $comando->execute([
            $this->clientes_id,
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
    public function Excluir() {
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
