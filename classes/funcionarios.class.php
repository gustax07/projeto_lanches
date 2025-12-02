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

    public function Logar() {
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
}
