<?php

require_once('banco.class.php');


class Promocoes{
    public int $id;
    public string $nome_promocao;
    public float $preco_promocional;
    public DateTime $data_validade;
    public int $id_item_fk;
    public int $status;


    public function Listar(){
        $sql = "SELECT p.id, p.nome_promocao, p.preco_promocional, p.data_validade, p.status, i.preco, i.imagem, i.nome FROM promocoes p INNER JOIN itens i ON p.id_item_fk = i.id;";
        $banco = Banco::conectar();
        $comando = $banco->prepare($sql);
        $comando->execute();
        $arr_resultado = $comando->fetchAll(PDO::FETCH_ASSOC);
        Banco::desconectar();
        return $arr_resultado;
    }

}

?>