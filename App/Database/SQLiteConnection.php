<?php

namespace XS\BX24\Trial\Database;


use PDO;


class SQLiteConnection implements iConnection
{

    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public static function create(array $params): iConnection
    {

        return new self(new \PDO(
            "sqlite:{$params['host']}",
            $params['username'],
            $params['password'],
            $params['options'] ?? []
        ));
    }


    public function isTableExists(string $tableName): bool
    {
        $stmt = $this->pdo
            ->prepare("SELECT name FROM sqlite_master WHERE type='table' AND name=:table_name");
        $stmt->execute([':table_name' => $tableName]);
        return $stmt->fetch()['name'] === $tableName;
    }

    public function pdo(): \PDO
    {
        return $this->pdo;
    }
}