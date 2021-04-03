<?php

namespace XS\BX24\Trial\Database;


use PDO;

class SQLite extends Connection
{

    static $instance = null;

    public static function create($path): iConnection
    {
        return new self(new \PDO(
            "sqlite:$path",
            '',
            '',
            [
                \PDO::ATTR_EMULATE_PREPARES   => false,
                \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC
            ]
        ));
    }


    public function isTableExists(string $tableName): bool
    {
        $stmt = $this->connection
            ->prepare("SELECT name FROM sqlite_master WHERE type='table' AND name=:table_name");
        $stmt->execute([':table_name' => $tableName]);
        return $stmt->fetch()['name'] === $tableName;
    }
}