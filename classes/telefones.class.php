<?php

require_once("banco.class.php");

class Telefones
{
    public $id;
    public $id_usuarios_fk;
    public $numero;

    //listar numeros
    public function Listar() {
        $sql = "SELECT * FROM telefones";
        $banco = Banco::conectar();
        $comando = $banco->prepare($sql);
        $comando->execute();
        $arr_resultado = $comando->fetchAll(PDO::FETCH_ASSOC);
        Banco::desconectar();
        return $arr_resultado;
    }

    //listar numeros por id com innerjoin com o usuario
    public function ListarInnerJoin() {
        $sql = "SELECT * FROM telefones WHERE id_usuarios_fk = ? INNER JOIN usuarios ON telefones.id_usuarios_fk = usuarios.id";
        $banco = Banco::conectar();
        $comando = $banco->prepare($sql);
        $comando->execute([
            $this->id_usuarios_fk
        ]);
        $arr_resultado = $comando->fetchAll(PDO::FETCH_ASSOC);
        Banco::desconectar();
        return $arr_resultado;
    }

    //cadastrar o numero
    public function Cadastrar() {
        $sql = "INSERT INTO telefones (id_usuarios_fk, numero) VALUES (?, ?)";
        $banco = Banco::conectar();
        $comando = $banco->prepare($sql);
        $comando->execute([
            $this->id_usuarios_fk,
            $this->numero
        ]);
        Banco::desconectar();
        return $comando->rowCount();
    }

    //editar o numero
    public function Editar() {
        $sql = "UPDATE telefones SET id_usuarios_fk = ?, numero = ? WHERE id = ?";
        $banco = Banco::conectar();
        $comando = $banco->prepare($sql);
        $comando->execute([
            $this->id_usuarios_fk,
            $this->numero,
            $this->id
        ]);
        Banco::desconectar();
        return $comando->rowCount();
    }

    //excluir o numero
    public function Excluir() {
        $sql = "DELETE FROM telefones WHERE id = ?";
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