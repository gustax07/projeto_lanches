<?php

require_once("banco.class.php");

class Telefones_clientes {

    public $id;
    public $id_clientes_fk;
    public $numero;

    //listar numeros
    public function Listar() {
        $sql = "SELECT * FROM telefones_clientes";
        $banco = Banco::conectar();
        $comando = $banco->prepare($sql);
        $comando->execute();
        $arr_resultado = $comando->fetchAll(PDO::FETCH_ASSOC);
        Banco::desconectar();
        return $arr_resultado;
    }

    //listar numeros por id com innerjoin com o cliente
    public function ListarInnerJoin() {
        $sql = "SELECT * FROM telefones_clientes WHERE id_clientes_fk = ? INNER JOIN clientes ON telefones_clientes.id_clientes_fk = clientes.id";
        $banco = Banco::conectar();
        $comando = $banco->prepare($sql);
        $comando->execute([
            $this->id_clientes_fk
        ]);
        $arr_resultado = $comando->fetchAll(PDO::FETCH_ASSOC);
        Banco::desconectar();
        return $arr_resultado;
    }

    //adicionar telefones do cliente
    public function Cadastrar() {
        $sql = "INSERT INTO telefones_clientes (id_clientes_fk, numero) VALUES (?, ?)";
        $banco = Banco::conectar();
        $comando = $banco->prepare($sql);
        $comando->execute([
            $this->id_clientes_fk,
            $this->numero
        ]);
        Banco::desconectar();
        return $comando->rowCount();
    }

    //editar telefone do cliente
    public function Editar() {
        $sql = "UPDATE telefones_clientes SET id_clientes_fk = ?, numero = ? WHERE id = ?";
        $banco = Banco::conectar();
        $comando = $banco->prepare($sql);
        $comando->execute([
            $this->id_clientes_fk,
            $this->numero,
            $this->id
        ]);
        Banco::desconectar();
        return $comando->rowCount();
    }

    //excluir o telefone do cliente
    public function Excluir() {
        $sql = "DELETE FROM telefones_clientes WHERE id = ?";
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