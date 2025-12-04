<?php

require_once("banco.class.php");

class telefones_funcionarios
{
    public $id;
    public $id_funcionarios_fk;
    public $numero;

    //listar numeros dos funcionarios
    public function Listar() {
        $sql = "SELECT * FROM telefones_funcionarios";
        $banco = Banco::conectar();
        $comando = $banco->prepare($sql);
        $comando->execute();
        $arr_resultado = $comando->fetchAll(PDO::FETCH_ASSOC);
        Banco::desconectar();
        return $arr_resultado;
    }

    //listar numeros por id dos funcionarios com innerjoin com o funcionario
    public function ListarInnerJoin() {
        $sql = "SELECT * FROM telefones_funcionarios WHERE id_funcionarios_fk = ? INNER JOIN funcionarios ON telefones_funcionarios.id_funcionarios_fk = funcionarios.id";
        $banco = Banco::conectar();
        $comando = $banco->prepare($sql);
        $comando->execute([
            $this->id_funcionarios_fk
        ]);
        $arr_resultado = $comando->fetchAll(PDO::FETCH_ASSOC);
        Banco::desconectar();
        return $arr_resultado;
    }

    //cadastrar o numero do funcionario
    public function Cadastrar() {
        $sql = "INSERT INTO telefones_funcionarios (id_funcionarios_fk, numero) VALUES (?, ?)";
        $banco = Banco::conectar();
        $comando = $banco->prepare($sql);
        $comando->execute([
            $this->id_funcionarios_fk,
            $this->numero
        ]);
        Banco::desconectar();
        return $comando->rowCount();
    }

    //editar o numero de um funcionario
    public function Editar() {
        $sql = "UPDATE telefones_funcionarios SET id_funcionarios_fk = ?, numero = ? WHERE id = ?";
        $banco = Banco::conectar();
        $comando = $banco->prepare($sql);
        $comando->execute([
            $this->id_funcionarios_fk,
            $this->numero,
            $this->id
        ]);
        Banco::desconectar();
        return $comando->rowCount();
    }

    //excluir o numero de um funcionario
    public function Excluir() {
        $sql = "DELETE FROM telefones_funcionarios WHERE id = ?";
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