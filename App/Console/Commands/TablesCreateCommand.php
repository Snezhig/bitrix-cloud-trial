<?php


namespace XS\BX24\Trial\Console\Commands;


use XS\BX24\Trial\Console\CommandContract;
use XS\BX24\Trial\Database\Connection;

class TablesCreateCommand implements CommandContract
{

    public function __construct(array $arguments = [])
    {
    }

    public function handle()
    {
        $connection = Connection::getInstance();
        if(!$connection->isTableExists('users')){
            $connection->pdo()->exec('CREATE TABLE users (bx_id integer primary key not null , last_lead_timestamp timestamp not null)');
        }
        if(!$connection->isTableExists('cron_tasks')){
            $connection->pdo()->exec('CREATE TABLE cron_tasks (name varchar primary key not null, executed timestamp  not null, next timestamp not null)');
        }
    }
}