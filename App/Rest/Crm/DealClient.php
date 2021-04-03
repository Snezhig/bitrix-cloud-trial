<?php

namespace XS\BX24\Trial\Rest\Crm;


use XS\BX24\Trial\Rest\iResponse;
use XS\BX24\Trial\Rest\RestClient;

class DealClient extends RestClient
{
    const METHODS = [
        'list' => 'crm.deal.list',
        'add'  => 'crm.deal.add'
    ];

    public function list($params = []): iResponse
    {
        return $this->client->call(self::METHODS['list'], $params);
    }

    public function add($params = []): iResponse
    {
        return $this->client->call(self::METHODS['add'], $params);
    }
}