<?php

require_once("banco.class.php");

class Clientes
{
    public $id;
    public $nome;
    public $email;
    public $senha;
    // public $criado_em;


    //listar clientes
    public function Listar()
    {
        $sql = "SELECT * FROM clientes";
        $banco = Banco::conectar();
        $comando = $banco->prepare($sql);
        $comando->execute();
        $arr_resultado = $comando->fetchAll(PDO::FETCH_ASSOC);
        Banco::desconectar();
        return $arr_resultado;
    }

    //listar clientes por ID
    public function ListarPorID()
    {
        $sql = "SELECT * FROM clientes WHERE id = ?";
        $banco = Banco::conectar();
        $comando = $banco->prepare($sql);
        $comando->execute([
            $this->id
        ]);
        $arr_resultado = $comando->fetchAll(PDO::FETCH_ASSOC);
        Banco::desconectar();
        return $arr_resultado;
    }

    //adicionar clientes
    public function Cadastrar()
    {
        $sql = "INSERT INTO clientes (nome, email, senha) VALUES (?, ?, ?)";
        $banco = Banco::conectar();
        $comando = $banco->prepare($sql);
        $comando->execute([
            $this->nome,
            $this->email,
            $this->senha
        ]);
        Banco::desconectar();
        return $comando->rowCount();
    }

    //editar cliente
    public function Editar()
    {
        $sql = "UPDATE clientes SET nome = ?, email = ?, senha = ? WHERE id = ?";
        $banco = Banco::conectar();
        $comando = $banco->prepare($sql);
        $comando->execute([
            $this->nome,
            $this->email,
            $this->senha,
            $this->id
        ]);
        Banco::desconectar();
        return $comando->rowCount();
    }

    //excluir um cliente
    public function Excluir()
    {
        $sql = "DELETE FROM clientes WHERE id = ?";
        $banco = Banco::conectar();
        $comando = $banco->prepare($sql);
        $comando->execute([
            $this->id
        ]);
        Banco::desconectar();
        return $comando->rowCount();
    }

    //logar no sistema
    public function Logar()
    {
        $sql = "SELECT * FROM clientes WHERE email = ? AND senha = ?";
        $banco = Banco::conectar();
        $comando = $banco->prepare($sql);
        $comando->execute([
            $this->email,
            $hash = hash('sha256', $this->senha)
        ]);
        $arr_resultado = $comando->fetchAll(PDO::FETCH_ASSOC);
        Banco::desconectar();
        return $arr_resultado;
    }

}
