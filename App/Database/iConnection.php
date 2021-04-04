<?php


namespace XS\BX24\Trial\Database;


interface iConnection
{

    public function pdo(): \PDO;

    public static function create(array $params): iConnection;

    public function isTableExists(string $tableName): bool;

}