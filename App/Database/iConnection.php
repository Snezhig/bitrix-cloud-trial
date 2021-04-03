<?php


namespace XS\BX24\Trial\Database;


interface iConnection
{
    public function isTableExists(string $tableName): bool;

    public function pdo(): \PDO;
}