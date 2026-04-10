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
    public function Listar($pagina = 1, $itensPorPagina = 5)
{
    $offset = ($pagina - 1) * $itensPorPagina;

    $sql = "SELECT i.*, p.preco_promocional, p.id AS id_promocao 
            FROM itens i 
            LEFT JOIN promocoes p ON i.id = p.id_item_fk 
            AND p.status = 1 
            AND (p.data_validade >= CURDATE() OR p.data_validade IS NULL)
            ORDER BY i.nome ASC
            LIMIT :limit OFFSET :offset";

    $banco = Banco::conectar();
    $comando = $banco->prepare($sql);
    $comando->bindValue(':limit', $itensPorPagina, PDO::PARAM_INT);
    $comando->bindValue(':offset', $offset, PDO::PARAM_INT);
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
        $sql = "SELECT i.id, i.nome, c.nome AS categoria, i.descricao, i.preco, i.imagem, i.id_categoria_fk
                FROM itens i 
                INNER JOIN categorias c ON i.id_categoria_fk = c.id ORDER BY id ASC";
        $banco = Banco::conectar();
        $comando = $banco->prepare($sql);
        $comando->execute();
        $arr_resultado = $comando->fetchAll(PDO::FETCH_ASSOC);
        Banco::desconectar();
        return $arr_resultado;
    }

    public function PesquisarPorNome($termo)
    {
        $sql = "SELECT i.id, i.nome, c.nome AS categoria, i.descricao, i.preco, i.imagem, i.id_categoria_fk
                FROM itens i 
                INNER JOIN categorias c ON i.id_categoria_fk = c.id WHERE i.nome LIKE :termo or i.descricao LIKE :termo ORDER BY id ASC";
        $banco = Banco::conectar();
        $comando = $banco->prepare($sql);
        $comando->bindValue(":termo", "%$termo%");
        $comando->execute();
        $arr_resultado = $comando->fetchAll(PDO::FETCH_ASSOC);
        Banco::desconectar();
        return $arr_resultado;
    }

    public function ListarPorCategoria()
    {
        $sql = "SELECT * FROM itens WHERE id_categoria_fk = ?";
        $banco = Banco::conectar();
        $comando = $banco->prepare($sql);
        $comando->execute([
            $this->id_categoria_fk
        ]);
        $arr_resultado = $comando->fetchAll(PDO::FETCH_ASSOC);
        Banco::desconectar();
        return $arr_resultado;
    }

    //descobrir quantas páginas existem para os itens
    public function QuantidadePaginas($itensPorPagina = 24)
    {
        $sql = "SELECT COUNT(*) AS total FROM itens";
        $banco = Banco::conectar();
        $comando = $banco->prepare($sql);
        $comando->execute();
        $arr_resultado = $comando->fetch(PDO::FETCH_ASSOC);
        Banco::desconectar();

        return ceil((int)$arr_resultado['total'] / $itensPorPagina);
    }
    public function ListarPromocoes(){
        $sql = "SELECT id, nome, imagem, preco FROM itens;";
        $banco = Banco::conectar();
        $comando = $banco->prepare($sql);
        $comando->execute();
        $arr_resultado = $comando->fetchAll(PDO::FETCH_ASSOC);
        Banco::desconectar();
        return $arr_resultado;
    }
}
