<?php

require_once("banco.class.php");

class Pedido_Itens
{
    public $id;
    public $id_pedidos_fk;
    public $id_itens_fk;
    public $quantidade;

    //listar os pedidos com inner join com a tabela pedidos e a tabela itens
    public function ListarPedidoInnerJoinComID()
    {
        $sql = "SELECT 
    p.id AS id_pedido,
    p.data_pedido,
    p.observacoes,
    i.nome AS Pedido,
    i.descricao,
    i.preco,
    pi.quantidade
FROM pedido_itens pi
JOIN pedidos p ON p.id = pi.id_pedidos_fk
JOIN itens i ON i.id = pi.id_itens_fk
WHERE p.id = ?;";
        $banco = Banco::conectar();
        $comando = $banco->prepare($sql);
        $comando->execute([
            $this->id_pedidos_fk
        ]);
        $arr_resultado = $comando->fetchAll(PDO::FETCH_ASSOC);
        Banco::desconectar();
        return $arr_resultado;
    }

    //listar um pedido por id + innerJoin com a tabela de categoria
    public function ListarInnerJoinPorID()
    {
        $sql = "SELECT * FROM pedido_itens WHERE id = ? 
        INNER JOIN pedidos ON pedido_itens.id_pedidos_fk = pedidos.id 
        INNER JOIN itens ON pedido_itens.id_itens_fk = itens.id";
        $banco = Banco::conectar();
        $comando = $banco->prepare($sql);
        $comando->execute([
            $this->id
        ]);
        $arr_resultado = $comando->fetchAll(PDO::FETCH_ASSOC);
        Banco::desconectar();
        return $arr_resultado;
    }

    //adicionar um novo pedido_itens
    public function Cadastrar()
    {
        $sql = "INSERT INTO pedido_itens (id_pedidos_fk, id_itens_fk, quantidade) VALUES (?, ?, ?)";
        $banco = Banco::conectar();
        $comando = $banco->prepare($sql);
        $comando->execute([
            $this->id_pedidos_fk,
            $this->id_itens_fk,
            $this->quantidade
        ]);
        Banco::desconectar();
        return $comando->rowCount();
    }


    //editar um pedido_itens
    public function Editar()
    {
        $sql = "UPDATE pedido_itens SET id_pedidos_fk = ?, id_itens_fk = ?, quantidade = ? WHERE id = ?";
        $banco = Banco::conectar();
        $comando = $banco->prepare($sql);
        $comando->execute([
            $this->id_pedidos_fk,
            $this->id_itens_fk,
            $this->quantidade,
            $this->id
        ]);
        Banco::desconectar();
        return $comando->rowCount();
    }

    //excluir um pedido_itens
    public function Excluir()
    {
        $sql = "DELETE FROM pedido_itens WHERE id_pedidos_fk = ?";
        $banco = Banco::conectar();
        $comando = $banco->prepare($sql);
        $comando->execute([
            $this->id_pedidos_fk
        ]);
        Banco::desconectar();
        return $comando->rowCount();
    }
}
