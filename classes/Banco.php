<?php
namespace App;
use PDO;
use PDOException;
$dotenv = \Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();
class Banco
{
    private static $dbNome = null;
    private static $dbHost = null;
    private static $dbUsuario = null;
    private static $dbSenha = null;
    private static $dbPort = null;

    private static $cont = null;

    public static function conectar()
    {

    self::$dbHost = $_ENV['DB_HOST'] ?? 'db';
    self::$dbPort = $_ENV['DB_PORT'] ?? '3306';
    self::$dbUsuario = $_ENV['DB_USER'] ?? 'db';
    self::$dbSenha = $_ENV['DB_PASS'] ?? 'db';
    self::$dbNome = $_ENV['DB_NAME'] ?? 'db';

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
