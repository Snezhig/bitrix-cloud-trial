<?php

namespace XS\BX24\Trial;

use XS\BX24\Trial\Console\Command;
use XS\BX24\Trial\Database\Connection;
use XS\BX24\Trial\Database\SQLite;

class App
{

    /**
     * @throws Console\Exceptions\CommandNotFound
     */
    public function run()
    {
        Connection::addConnection('sqlite', SQLite::Create('/var/www/db.sqlite3'));
        Command::exec();
    }
}