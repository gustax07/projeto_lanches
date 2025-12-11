<?php

class Banco
{
    private static $dbNome = 'projeto_lanches';
    private static $dbHost = '10.141.46.35';
    private static $dbUsuario = 'admin';
    private static $dbSenha = 'senac';
    
    private static $cont = null;
    
    public function __construct() 
    {
        die('A função Init nao é permitido!');
    }
    
    public static function conectar()
    {
        if (null == self::$cont)
        {
            try
            {
                self::$cont = new PDO(
                    "mysql:host=".self::$dbHost.";dbname=".self::$dbNome.";charset=utf8mb4",
                    self::$dbUsuario,
                    self::$dbSenha,
                    array(
                        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4"
                    )
                );

                // Garantia extra (não é obrigatório mas evita doença)
                self::$cont->exec("SET CHARACTER SET utf8mb4");
            }
            catch(PDOException $exception)
            {
                die($exception->getMessage());
            }
        }
        return self::$cont;
    }
    
    public static function desconectar()
    {
        self::$cont = null;
    }
}

?>
