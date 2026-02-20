<?php

class Banco
{
    private static $dbNome = null;
    private static $dbHost = null;
    private static $dbUsuario = null;
    private static $dbSenha = null;
    private static $dbPort = null;

    private static $cont = null;

    public function __construct()
    {
        die('A função Init nao é permitido!');
    }

    public static function conectar()
    {
        if (file_exists(__DIR__ . '/../.env')) {
            $linhas = file(__DIR__ . '/../.env', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            foreach ($linhas as $linha) {
                if (strpos(trim($linha), '#') === 0) continue; // Ignora comentários
                list($nome, $valor) = explode('=', $linha, 2);
                putenv(trim($nome) . '=' . trim($valor));
            }
        }

        self::$dbHost = getenv('DB_HOST');
        self::$dbPort = getenv('DB_PORT');
        self::$dbUsuario = getenv('DB_USER');
        self::$dbSenha = getenv('DB_PASS');
        self::$dbNome = getenv('DB_NAME');

        if (null == self::$cont) {
            try {
                $dsn = "mysql:host=" . self::$dbHost . ";port=" . self::$dbPort . ";dbname=" . self::$dbNome . ";charset=utf8mb4";

                $opcoes = array(
                    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4",
                    PDO::MYSQL_ATTR_SSL_CA => __DIR__ . '/ca.pem',
                    PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => false,
                    PDO::ATTR_PERSISTENT => true
                );

                self::$cont = new PDO($dsn, self::$dbUsuario, self::$dbSenha, $opcoes);
                self::$cont->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $exception) {
                die("Erro na conexão: " . $exception->getMessage());
            }
        }
        return self::$cont;
    }


    public static function desconectar()
    {
        self::$cont = null;
    }
}
