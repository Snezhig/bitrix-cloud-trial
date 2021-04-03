<?php


namespace XS\BX24\Trial\Console\Commands;


use XS\BX24\Trial\Console\CommandContract;
use XS\BX24\Trial\Database\Connection;
use XS\BX24\Trial\Models\User;
use XS\BX24\Trial\Models\UserMapper;

class UserAddCommand implements CommandContract
{

    private $bxId = null;
    private $lastLeadTimestamp = null;

    public function __construct(array $arguments = [])
    {
        $this->bxId = current($arguments);
        if (count($arguments) > 1) {
            $this->lastLeadTimestamp = end($arguments);
        } else {
            $this->lastLeadTimestamp = (new \DateTime())->getTimestamp();
        }
    }

    public function handle()
    {
        $mapper = new UserMapper(Connection::getConnection('sqlite')->pdo());
        $user = new User(['bx_id' => $this->bxId, 'last_lead_timestamp' => $this->lastLeadTimestamp]);
        if ($mapper->insert($user)) {
            echo "User has been created\n";
        } else {
            echo "User has not been created\n";
        }
    }
}