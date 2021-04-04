<?php

namespace XS\BX24\Trial;

use Dotenv\Dotenv;
use Dotenv\Repository\Adapter\EnvConstAdapter;
use Dotenv\Repository\Adapter\PutenvAdapter;
use Dotenv\Repository\RepositoryBuilder;
use XS\BX24\Trial\Console\Command;

class App
{

    /**
     * @throws Console\Exceptions\CommandNotFound
     */
    public function run()
    {
        $repository = RepositoryBuilder::createWithNoAdapters()
            ->addAdapter(EnvConstAdapter::class)
            ->addWriter(PutenvAdapter::class)
            ->allowList([
                'ENABLE_LEAD_AUTOGENERATE',
                'BITRIX_URL',
                'BITRIX_KEY',
                'BITRIX_KEY_USER_ID',
                'DB_DRIVER',
                'DB_HOST',
                'DB_NAME',
                'DB_USER',
                'DB_PASSWORD',
            ])->immutable()->make();
        Dotenv::create($repository, __DIR__ . '/../.docker')->load();
        Command::exec();
    }
}