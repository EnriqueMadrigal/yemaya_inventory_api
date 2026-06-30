<?php
namespace App\Config;

#use Dotenv\Dotenv;

class Database {
    private static $instance = null;
    private $connection;

    private function __construct() {
        #$dotenv = Dotenv::createImmutable(__DIR__ . '/../../');
        #$dotenv->load();

        $dsn = "mysql:host={$_ENV['DB_HOST']};dbname={$_ENV['DB_NAME']};PORT=3307";
        $this->connection = new \PDO($dsn, $_ENV['DB_USER'], $_ENV['DB_PASS'], [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC
        ]);
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance->connection;
    }
}
