<?php


namespace XS\BX24\Trial\Database;


use PDO;

abstract class Connection implements iConnection
{
    private static array $connections = [];
    protected ?PDO $connection = null;


    public function __construct(PDO $PDO)
    {
        $this->connection = $PDO;
    }


    public static function addConnection($name, iConnection $connection)
    {
        self::$connections[$name] = $connection;
        return $connection;
    }

    public static function getConnection($name): ?iConnection
    {
        return self::$connections[$name];
    }

    public function pdo(): PDO
    {
        return $this->connection;
    }
}