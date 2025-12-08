<?php
require_once("banco.class.php");

class Itens
{
    public $id;
    public $nome;
    public $descricao;
    public $preco;
    public $imagem;
    public $id_categoria_fk;

    //listar os itens
    public function Listar()
    {
        $sql = "SELECT * FROM itens";
        $banco = Banco::conectar();
        $comando = $banco->prepare($sql);
        $comando->execute();
        $arr_resultado = $comando->fetchAll(PDO::FETCH_ASSOC);
        Banco::desconectar();
        return $arr_resultado;
    }

    //cadastrar um novo item
    public function Cadastrar()
    {
        $sql = "INSERT INTO itens (nome, descricao, preco, imagem, id_categoria_fk) VALUES (?, ?, ?, ?, ?)";
        $banco = Banco::conectar();
        $comando = $banco->prepare($sql);
        $comando->execute([
            $this->nome,
            $this->descricao,
            $this->preco,
            $this->imagem,
            $this->id_categoria_fk
        ]);
        Banco::desconectar();
        return $comando->rowCount();
    }

    //editar um item
    public function Editar()
    {
        $sql = "UPDATE itens SET nome = ?, descricao = ?, preco = ?, imagem = ?, id_categoria_fk = ? WHERE id = ?";
        $banco = Banco::conectar();
        $comando = $banco->prepare($sql);
        $comando->execute([
            $this->nome,
            $this->descricao,
            $this->preco,
            $this->imagem,
            $this->id_categoria_fk,
            $this->id
        ]);
        Banco::desconectar();
        return $comando->rowCount();
    }

    //excluir um item
    public function Excluir()
    {
        $sql = "DELETE FROM itens WHERE id = ?";
        $banco = Banco::conectar();
        $comando = $banco->prepare($sql);
        $comando->execute([
            $this->id
        ]);
        Banco::desconectar();
        return $comando->rowCount();
    }

    //listar item por id
    public function ListarPorID()
    {
        $sql = "SELECT * FROM itens WHERE id = ?";
        $banco = Banco::conectar();
        $comando = $banco->prepare($sql);
        $comando->execute([
            $this->id
        ]);
        $arr_resultado = $comando->fetchAll(PDO::FETCH_ASSOC);
        Banco::desconectar();
        return $arr_resultado;
    }

    //listar um item por id + innerJoin com a tabela de categoria
    public function ListarInnerJoin()
    {
        $sql = "SELECT * FROM itens WHERE id = ? INNER JOIN categorias ON itens.id_categoria_fk = categorias.id";
        $banco = Banco::conectar();
        $comando = $banco->prepare($sql);
        $comando->execute([
            $this->id
        ]);
        $arr_resultado = $comando->fetchAll(PDO::FETCH_ASSOC);
        Banco::desconectar();
        return $arr_resultado;
    }
}
?>