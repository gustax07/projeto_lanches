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
        $sql = "SELECT pi.id, i.nome AS Pedido, pi.quantidade, p.data_pedido, p.observacoes, i.descricao, i.preco
        FROM pedido_itens pi
        JOIN itens i ON pi.id_pedidos_fk = i.id
        JOIN pedidos p ON pi.id_pedidos_fk = p.id
        WHERE pi.id_pedidos_fk = ?;";
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
        $sql = "DELETE FROM pedido_itens WHERE id = ?";
        $banco = Banco::conectar();
        $comando = $banco->prepare($sql);
        $comando->execute([
            $this->id
        ]);
        Banco::desconectar();
        return $comando->rowCount();
    }
}
