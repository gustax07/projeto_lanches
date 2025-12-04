<?php

require_once('Banco.class.php');

class funcionarios
{
    public $id;
    public $nome;
    public $email;
    public $senha;
    public $id_cargos_fk;
    public $data_contratacao;

    public function Logar()
    {
        $sql = "SELECT * FROM funcionarios WHERE email = ? AND senha = ?";
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
        $sql = "INSERT INTO funcionarios (nome, email, senha, data_contratacao, id_cargos_fk)
        VALUES (?, ?, ?, ?, ?)";
        $banco = Banco::conectar();
        $comando = $banco->prepare($sql);
        $comando->execute([
            $this->nome,
            $this->email,
            $$hash = hash('sha256', $this->senha),
            $this->data_contratacao,
            $this->id_cargos_fk
        ]);
        Banco::desconectar();
        return $comando->rowCount();
    }
    //Listar funcionarios
    public function Listar()
    {
        $sql = "SELECT * FROM funcionarios";
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
        $sql = "SELECT * FROM funcionarios WHERE id = ?";
        $banco = Banco::conectar();
        $comando = $banco->prepare($sql);
        $comando->execute([
            $this->id
        ]);
        $arr_resultado = $comando->fetchAll(PDO::FETCH_ASSOC);
        Banco::desconectar();
        return $arr_resultado;
    }

    //Editar funcionarios
    public function Editar()
    {
        if ($this->senha == null) {
            $sql = "UPDATE funcionarios SET nome = ?, email = ?, data_contratacao = ?, id_cargos_fk = ? WHERE id = ?";
            $banco = Banco::conectar();
            $comando = $banco->prepare($sql);
            $comando->execute([
                $this->nome,
                $this->email,
                $this->data_contratacao,
                $this->id_cargos_fk,
                $this->id
            ]);
            Banco::desconectar();
            return $comando->rowCount();
        } else {
            $sql = "UPDATE funcionarios SET nome = ?, email = ?, senha = ?, data_contratacao = ?, id_cargos_fk = ? WHERE id = ?";
            $banco = Banco::conectar();
            $comando = $banco->prepare($sql);
            $comando->execute([
                $this->nome,
                $this->email,
                $$hash = hash('sha256', $this->senha),
                $this->data_contratacao,
                $this->id_cargos_fk,
                $this->id
            ]);
            Banco::desconectar();
            return $comando->rowCount();
        }
    }
    public function ListarFuncionarios()
    {
        $sql = "SELECT funcionarios.id, funcionarios.nome, funcionarios.email, funcionarios.data_contratacao, cargos.nome_cargo
                from funcionarios
                INNER JOIN cargos ON id_cargos_fk = cargos.id_cargo;";
        $banco = Banco::conectar();
        $comando = $banco->prepare($sql);
        $comando->execute();
        $arr_resultado = $comando->fetchAll(PDO::FETCH_ASSOC);
        Banco::desconectar();
        return $arr_resultado;
    }

    //Excluir funcionarios
    public function Excluir()
    {
        $sql = "DELETE FROM funcionarios WHERE id = ?";
        $banco = Banco::conectar();
        $comando = $banco->prepare($sql);
        $comando->execute([
            $this->id
        ]);
        Banco::desconectar();
        return $comando->rowCount();
    }
}
