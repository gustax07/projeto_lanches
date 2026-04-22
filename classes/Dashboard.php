<?php

namespace App;

class Dashboard extends Banco {
    public function ListarTodos() {
        $sql = "SELECT
                (SELECT COUNT(*) FROM categorias) as total_categorias,
                (SELECT COUNT(*) FROM enderecos) as total_enderecos,
                (SELECT COUNT(*) FROM itens) as total_produtos,
                (SELECT COUNT(*) FROM pedidos) as total_pedidos,
                (SELECT COUNT(*) FROM telefones) as total_telefones,
                (SELECT COUNT(*) FROM tipos) as total_cargos,
                (SELECT COUNT(*) FROM usuarios WHERE id_tipo_fk != 0) as total_funcionarios,
                (SELECT COUNT(*) FROm usuarios WHERE id_tipo_fk = 0) as total_clientes";
        
        $comando = self::conectar()->prepare($sql);
        $comando->execute();
        
        return $comando->fetchAll();
    }
}

?>