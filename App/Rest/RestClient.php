<?php


namespace XS\BX24\Trial\Rest;


use XS\BX24\Trial\Rest\Crm\DealClient;
use XS\BX24\Trial\Rest\Crm\LeadClient;
use XS\BX24\Trial\Rest\Tasks\TaskClient;
use XS\BX24\Trial\Rest\TimeMan\TimeManClient;

class RestClient
{
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    protected function call($method, array $params): iResponse
    {
        return $this->client->call($method, $params);
    }

    public static function makeClient(string $className, Client $client = null)
    {
        return new $className($client ?? Client::getInstance());
    }

    public static function timeman(Client $client = null): TimeManClient
    {
        return self::makeClient(TimeManClient::class, $client);
    }

    public static function crmDeal(Client $client = null): DealClient
    {
        return self::makeClient(DealClient::class, $client);
    }

    public static function crmLead(Client $client = null): LeadClient
    {
        return self::makeClient(LeadClient::class, $client);
    }

    public static function tasksTask(Client $client = null): TaskClient
    {
        return self::makeClient(TaskClient::class, $client);
    }

    public function getClient()
    {
        return $this->client;
    }
}