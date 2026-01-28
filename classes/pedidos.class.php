<?php

require_once("banco.class.php");

class Pedidos
{
    public $id;
    public $id_usuarios_fk;
    public $id_enderecos_fk;
    public $status;
    public $data_pedido;
    public $observacoes;

    //listar os pedidos com inner join com a tabela usuarios e a tabela enderecos
    public function ListarInnerJoin()
    {
        $sql = "SELECT 
p.id,
u.nome,
p.status,
p.data_pedido,
p.observacoes
FROM pedidos p
JOIN usuarios u on u.id = p.id_usuarios_fk;";
        $banco = Banco::conectar();
        $comando = $banco->prepare($sql);
        $comando->execute();
        $arr_resultado = $comando->fetchAll(PDO::FETCH_ASSOC);
        Banco::desconectar();
        return $arr_resultado;
    }

    public function ListarInnerJoinPorID()
    {
        $sql = "SELECT * FROM pedidos WHERE id = ? 
        INNER JOIN usuarios ON pedidos.id_usuarios_fk = usuarios.id 
        INNER JOIN enderecos ON pedidos.id_enderecos_fk = enderecos.id";
        $banco = Banco::conectar();
        $comando = $banco->prepare($sql);
        $comando->execute([
            $this->id
        ]);
        $arr_resultado = $comando->fetchAll(PDO::FETCH_ASSOC);
        Banco::desconectar();
        return $arr_resultado;
    }

    //adicionar um novo pedido
    public function Cadastrar()
    {
        $sql = "INSERT INTO pedidos (id_usuarios_fk, id_enderecos_fk, status, data_pedido, observacoes) VALUES (?, ?, ?, ?, ?)";
        $banco = Banco::conectar();
        $comando = $banco->prepare($sql);
        $comando->execute([
            $this->id_usuarios_fk,
            $this->id_enderecos_fk,
            $this->status,
            $this->data_pedido,
            $this->observacoes
        ]);
        Banco::desconectar();
        return $comando->rowCount();
    }

    //editar um pedido
    public function Editar()
    {
        $sql = "UPDATE pedidos SET id_usuarios_fk = ?, id_enderecos_fk = ?, status = ?, data_pedido = ?, observacoes = ? WHERE id = ?";
        $banco = Banco::conectar();
        $comando = $banco->prepare($sql);
        $comando->execute([
            $this->id_usuarios_fk,
            $this->id_enderecos_fk,
            $this->status,
            $this->data_pedido,
            $this->observacoes,
            $this->id
        ]);
        Banco::desconectar();
        return $comando->rowCount();
    }

    //excluir um pedido
    public function Excluir()
    {
        $sql = "DELETE FROM pedidos WHERE id = ?";
        $banco = Banco::conectar();
        $comando = $banco->prepare($sql);
        $comando->execute([
            $this->id
        ]);
        Banco::desconectar();
        return $comando->rowCount();
    }
}
