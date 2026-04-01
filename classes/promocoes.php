<?php

require_once('banco.class.php');


class Promocoes{
    public $id;
    public $nome_promocao;
    public $preco_promocional;
    public $data_validade;
    public $id_item_fk;
    public $status;


    public function Listar(){
        $sql = "SELECT p.id, p.nome_promocao, p.preco_promocional, p.data_validade, p.status, i.preco, i.imagem, i.nome, p.id_item_fk FROM promocoes p INNER JOIN itens i ON p.id_item_fk = i.id;";
        $banco = Banco::conectar();
        $comando = $banco->prepare($sql);
        $comando->execute();
        $arr_resultado = $comando->fetchAll(PDO::FETCH_ASSOC);
        Banco::desconectar();
        return $arr_resultado;
    }

    public function Editar(){
        $sql = "UPDATE promocoes SET nome_promocao = ?, preco_promocional = ?, data_validade = ? WHERE id = ?";
        $banco = Banco::conectar();
        $comando = $banco->prepare($sql);
        $comando->execute([
            $this->nome_promocao, 
            $this->preco_promocional, 
            $this->data_validade,
            $this->id
        ]);
        Banco::desconectar();
        return $comando->rowCount();
    }

    public function AlterarStatus(){
        $sql = "UPDATE promocoes SET status = ? WHERE id = ?";
        $banco = Banco::conectar();
        $comando = $banco->prepare($sql);
        $comando->execute([
            $this->status,
            $this->id
        ]);
        Banco::desconectar();
        return $comando->rowCount();
    }

    public function Cadastrar(){
        $sql = "INSERT INTO promocoes (nome_promocao, preco_promocional, data_validade, id_item_fk, status) VALUES (?, ?, ?, ?, ?)";
        $banco = Banco::conectar();
        $comando = $banco->prepare($sql);
        $comando->execute([
            $this->nome_promocao, 
            $this->preco_promocional, 
            $this->data_validade,
            $this->id_item_fk,
            $this->status
        ]);
        Banco::desconectar();
        return $comando->rowCount();
    }

    public function Excluir(){
        $sql = "DELETE FROM promocoes WHERE id = ?";
        $banco = Banco::conectar();
        $comando = $banco->prepare($sql);
        $comando->execute([
            $this->id
        ]);
        Banco::desconectar();
        return $comando->rowCount();
    }

    //sistema de pesquisa usando sintaxe LIKE
    public function PesquisarPromocao($termo){
        $sql = "SELECT p.id, p.nome_promocao, p.preco_promocional, p.data_validade, p.status, i.preco, i.imagem, i.nome, p.id_item_fk 
        FROM promocoes p 
        INNER JOIN itens i ON p.id_item_fk = i.id
        WHERE p.nome_promocao LIKE :termo OR i.nome LIKE :termo ORDER BY id ASC";
        $banco = Banco::conectar();
        $comando = $banco->prepare($sql);
        $comando->bindValue(":termo", "%$termo%");
        $comando->execute();
        $arr_resultado = $comando->fetchAll(PDO::FETCH_ASSOC);
        Banco::desconectar();
        return $arr_resultado;
    }
}

?>