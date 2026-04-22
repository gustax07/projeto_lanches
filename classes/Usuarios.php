<?php

namespace App;
use PDO;

class Usuarios extends Banco
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
        
        $comando = self::conectar()->prepare($sql);
        $comando->execute([
            $this->email,
            $hash = hash('sha256', $this->senha)
        ]);
        $arr_resultado = $comando->fetchAll(PDO::FETCH_ASSOC);
        
        return $arr_resultado;
    }
    public function Cadastrar()
    {
        $sql = "INSERT INTO usuarios (nome, email, senha, data_cadastro, id_tipo_fk)
        VALUES (?, ?, ?, ?, ?)";
        
        $comando = self::conectar()->prepare($sql);
        $comando->execute([
            $this->nome,
            $this->email,
            $$hash = hash('sha256', $this->senha),
            $this->data_cadastro,
            $this->id_tipo_fk
        ]);
        
        return $comando->rowCount();
    }
    //Listar usuarios
    public function ListarFuncionarios()
    {
        $sql = "SELECT * FROM usuarios WHERE id_tipo_fk != 0";
        
        $comando = self::conectar()->prepare($sql);
        $comando->execute();
        $arr_resultado = $comando->fetchAll(PDO::FETCH_ASSOC);
        
        return $arr_resultado;
    }
    public function ListarFuncionariosPorINNERJOIN()
    {
        $sql = "SELECT u.foto, 
u.id, 
u.nome, 
u.email, 
u.data_cadastro, 
u.id_tipo_fk,
t.nome_tipo AS cargo
FROM usuarios u
JOIN tipos t ON u.id_tipo_fk = t.id
WHERE u.id_tipo_fk != 0;";
        
        $comando = self::conectar()->prepare($sql);
        $comando->execute();
        $arr_resultado = $comando->fetchAll(PDO::FETCH_ASSOC);
        
        return $arr_resultado;
    }
     public function ListarFuncionariosPorINNERJOINECARGO()
    {
        $sql = "SELECT u.foto, 
                u.id, 
                u.nome, 
                u.email, 
                u.data_cadastro, 
                t.nome_tipo AS cargo
                FROM usuarios u
                JOIN tipos t ON u.id_tipo_fk = t.id
                WHERE u.id_tipo_fk = ?";
        
        $comando = self::conectar()->prepare($sql);
        $comando->execute([
            $this->id_tipo_fk
        ]);
        $arr_resultado = $comando->fetchAll(PDO::FETCH_ASSOC);
        
        return $arr_resultado;
    }
    //ListarPorID
    public function ListarPorID()
    {
        $sql = "SELECT nome, email, data_cadastro, id_tipo_fk, foto FROM usuarios WHERE id = ?";
        
        $comando = self::conectar()->prepare($sql);
        $comando->execute([
            $this->id
        ]);
        $arr_resultado = $comando->fetchAll(PDO::FETCH_ASSOC);
        
        return $arr_resultado;
    }
    public function ListarPorIDCargo()
    {
        $sql = "SELECT * FROM usuarios WHERE id_tipo_fk = ?";
        
        $comando = self::conectar()->prepare($sql);
        $comando->execute([
            $this->id_tipo_fk
        ]);
        $arr_resultado = $comando->fetchAll(PDO::FETCH_ASSOC);
        
        return $arr_resultado;
    }

    //Editar usuarios
    public function Editar()
    {
        if ($this->senha == null) {
            $sql = "UPDATE usuarios SET nome = ?, email = ? , id_tipo_fk = ? WHERE id = ?";
            
            $comando = self::conectar()->prepare($sql);
            $comando->execute([
                $this->nome,
                $this->email,
                $this->id_tipo_fk,
                $this->id
            ]);
            
            return $comando->rowCount();
        } else {
            $sql = "UPDATE usuarios SET nome = ?, email = ?, senha = ?,id_tipo_fk = ? WHERE id = ?";
            
            $comando = self::conectar()->prepare($sql);
            $comando->execute([
                $this->nome,
                $this->email,
                $$hash = hash('sha256', $this->senha),
                $this->id_tipo_fk,
                $this->id
            ]);
            
            return $comando->rowCount();
        }
    }


    //Excluir usuarios
    public function Excluir()
    {
        $sql = "DELETE FROM usuarios WHERE id = ?";
        
        $comando = self::conectar()->prepare($sql);
        $comando->execute([
            $this->id
        ]);
        
        return $comando->rowCount();
    }

    public function ListarClientes()
    {
        $sql = "SELECT * FROM usuarios WHERE id_tipo_fk = 0";
        
        $comando = self::conectar()->prepare($sql);
        $comando->execute();
        $arr_resultado = $comando->fetchAll(PDO::FETCH_ASSOC);
        
        return $arr_resultado;
    }

    public function ListarClientesPorID(){
        $sql = "SELECT * FROM usuarios WHERE id_tipo_fk = 0 AND id = ?";
        
        $comando = self::conectar()->prepare($sql);
        $comando->execute([
            $this->id
        ]);
        $arr_resultado = $comando->fetchAll(PDO::FETCH_ASSOC);
        
        return $arr_resultado;
    }

    public function MudarFoto()
    {
        $sql = "UPDATE usuarios SET foto = ? WHERE id = ?";
        
        $comando = self::conectar()->prepare($sql);
        $comando->execute([
            $this->foto,
            $this->id
        ]);
        
        return $comando->rowCount();
    }
}
