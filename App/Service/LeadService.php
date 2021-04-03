<?php

namespace XS\BX24\Trial\Service;

use Faker\Factory;
use Illuminate\Support\Collection;
use XS\BX24\Trial\Database\Connection;
use XS\BX24\Trial\Database\SQLite;
use XS\BX24\Trial\Models\UserMapper;
use XS\BX24\Trial\Rest\Client;
use XS\BX24\Trial\Rest\Crm\LeadClient;
use XS\BX24\Trial\Rest\RestClient;

class LeadService
{

    private LeadClient $client;

    public function __construct(LeadClient $client)
    {
        $this->client = $client;
    }

    public function generate()
    {
        $users = Collection::make((new UserMapper(Connection::getConnection('sqlite')->pdo()))->getAll());
        $user = $users->sort(static function ($first, $second) {
            return $first->getLastLeadTimestamp() > $second->getLastLeadTimestamp();
        })->first(static function ($user) {
            return (new UserService($user, new RestClient(Client::getInstance())))->isWorking();
        });
        if ($user === null) {
            //throw an exception
            return false;
        }
        $faker = Factory::create('ru_RU');
        $leadId = (int)$this->client->add([
            'fields' => [
                'TITLE' => $faker->name(),
                'PHONE' => [['VALUE' => $faker->phoneNumber, 'VALUE_TYPE' => 'WORK']],
                'EMAIL' => [['VALUE' => $faker->companyEmail, 'VALUE_TYPE' => 'WORK']],
            ]

        ])->getResult();
        $service = new TaskService($this->client);
        $service->createForLead($leadId, $user);
        return true;
    }
}