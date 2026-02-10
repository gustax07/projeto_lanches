<?php

require_once('Banco.class.php');

class Usuarios
{
    public $id;
    public $nome;
    public $email;
    public $senha;
    public $id_tipo_fk;
    public $data_cadastro;
    public $foto;

    public function Logar()
    {
        $sql = "SELECT * FROM usuarios WHERE email = ? AND senha = ?";
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
    public function Cadastrar()
    {
        $sql = "INSERT INTO usuarios (nome, email, senha, data_cadastro, id_tipo_fk)
        VALUES (?, ?, ?, ?, ?)";
        $banco = Banco::conectar();
        $comando = $banco->prepare($sql);
        $comando->execute([
            $this->nome,
            $this->email,
            $$hash = hash('sha256', $this->senha),
            $this->data_cadastro,
            $this->id_tipo_fk
        ]);
        Banco::desconectar();
        return $comando->rowCount();
    }
    //Listar usuarios
    public function Listar()
    {
        $sql = "SELECT * FROM usuarios";
        $banco = Banco::conectar();
        $comando = $banco->prepare($sql);
        $comando->execute();
        $arr_resultado = $comando->fetchAll(PDO::FETCH_ASSOC);
        Banco::desconectar();
        return $arr_resultado;
    }

    //ListarPorID
    public function ListarPorID()
    {
        $sql = "SELECT * FROM usuarios WHERE id = ?";
        $banco = Banco::conectar();
        $comando = $banco->prepare($sql);
        $comando->execute([
            $this->id
        ]);
        $arr_resultado = $comando->fetchAll(PDO::FETCH_ASSOC);
        Banco::desconectar();
        return $arr_resultado;
    }
    public function ListarPorIDCargo()
    {
        $sql = "SELECT * FROM usuarios WHERE id_tipo_fk = ?";
        $banco = Banco::conectar();
        $comando = $banco->prepare($sql);
        $comando->execute([
            $this->id_tipo_fk
        ]);
        $arr_resultado = $comando->fetchAll(PDO::FETCH_ASSOC);
        Banco::desconectar();
        return $arr_resultado;
    }

    //Editar usuarios
    public function Editar()
    {
        if ($this->senha == null) {
            $sql = "UPDATE usuarios SET nome = ?, email = ? , id_tipo_fk = ? WHERE id = ?";
            $banco = Banco::conectar();
            $comando = $banco->prepare($sql);
            $comando->execute([
                $this->nome,
                $this->email,
                $this->id_tipo_fk,
                $this->id
            ]);
            Banco::desconectar();
            return $comando->rowCount();
        } else {
            $sql = "UPDATE usuarios SET nome = ?, email = ?, senha = ?,id_tipo_fk = ? WHERE id = ?";
            $banco = Banco::conectar();
            $comando = $banco->prepare($sql);
            $comando->execute([
                $this->nome,
                $this->email,
                $$hash = hash('sha256', $this->senha),
                $this->id_tipo_fk,
                $this->id
            ]);
            Banco::desconectar();
            return $comando->rowCount();
        }
    }
    public function ListarFuncionarios()
    {
        $sql = "SELECT usuarios.id, usuarios.nome, usuarios.email, usuarios.data_cadastro, tipos.nome_tipo
                from usuarios
                INNER JOIN tipos ON id_tipo_fk = tipos.id;";
        $banco = Banco::conectar();
        $comando = $banco->prepare($sql);
        $comando->execute();
        $arr_resultado = $comando->fetchAll(PDO::FETCH_ASSOC);
        Banco::desconectar();
        return $arr_resultado;
    }

    //Excluir usuarios
    public function Excluir()
    {
        $sql = "DELETE FROM usuarios WHERE id = ?";
        $banco = Banco::conectar();
        $comando = $banco->prepare($sql);
        $comando->execute([
            $this->id
        ]);
        Banco::desconectar();
        return $comando->rowCount();
    }

    public function ListarClientes(){
        $sql = "SELECT * FROM usuarios WHERE id_tipo_fk = 0";
        $banco = Banco::conectar();
        $comando = $banco->prepare($sql);
        $comando->execute();
        $arr_resultado = $comando->fetchAll(PDO::FETCH_ASSOC);
        Banco::desconectar();
        return $arr_resultado;
    }

    public function MudarFoto() {
        $sql = "UPDATE usuarios SET foto = ? WHERE id = ?";
        $banco = Banco::conectar();
        $comando = $banco->prepare($sql);
        $comando->execute([
            $this->foto,
            $this->id
        ]);
        Banco::desconectar();
        return $comando->rowCount();
    }
}
