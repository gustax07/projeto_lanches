<?php

namespace App;
use PDO;

class Promocoes extends Banco
{
    public $id;
    public $nome_promocao;
    public $preco_promocional;
    public $data_validade;
    public $id_item_fk;
    public $status;


    public function Listar(){
        $sql = "SELECT p.id, p.nome_promocao, p.preco_promocional, p.data_validade, p.status, i.preco, i.imagem, i.nome, p.id_item_fk FROM promocoes p INNER JOIN itens i ON p.id_item_fk = i.id;";
        
        $comando = self::conectar()->prepare($sql);
        $comando->execute();
        $arr_resultado = $comando->fetchAll(PDO::FETCH_ASSOC);
        
        return $arr_resultado;
    }

    public function Editar(){
        $sql = "UPDATE promocoes SET nome_promocao = ?, preco_promocional = ?, data_validade = ? WHERE id = ?";
        
        $comando = self::conectar()->prepare($sql);
        $comando->execute([
            $this->nome_promocao, 
            $this->preco_promocional, 
            $this->data_validade,
            $this->id
        ]);
        
        return $comando->rowCount();
    }

    public function AlterarStatus(){
        $sql = "UPDATE promocoes SET status = ? WHERE id = ?";
        
        $comando = self::conectar()->prepare($sql);
        $comando->execute([
            $this->status,
            $this->id
        ]);
        
        return $comando->rowCount();
    }

    public function Cadastrar(){
        $sql = "INSERT INTO promocoes (nome_promocao, preco_promocional, data_validade, id_item_fk, status) VALUES (?, ?, ?, ?, ?)";
        
        $comando = self::conectar()->prepare($sql);
        $comando->execute([
            $this->nome_promocao, 
            $this->preco_promocional, 
            $this->data_validade,
            $this->id_item_fk,
            $this->status
        ]);
        
        return $comando->rowCount();
    }

    public function Excluir(){
        $sql = "DELETE FROM promocoes WHERE id = ?";
        
        $comando = self::conectar()->prepare($sql);
        $comando->execute([
            $this->id
        ]);
        
        return $comando->rowCount();
    }

    //sistema de pesquisa usando sintaxe LIKE
    public function PesquisarPromocao($termo){
        $sql = "SELECT p.id, p.nome_promocao, p.preco_promocional, p.data_validade, p.status, i.preco, i.imagem, i.nome, p.id_item_fk 
        FROM promocoes p 
        INNER JOIN itens i ON p.id_item_fk = i.id
        WHERE p.nome_promocao LIKE :termo OR i.nome LIKE :termo ORDER BY id ASC";
        
        $comando = self::conectar()->prepare($sql);
        $comando->bindValue(":termo", "%$termo%");
        $comando->execute();
        $arr_resultado = $comando->fetchAll(PDO::FETCH_ASSOC);
        
        return $arr_resultado;
    }
}

?>