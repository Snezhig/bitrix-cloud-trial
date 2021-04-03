<?php


namespace XS\BX24\Trial\Service;


use XS\BX24\Trial\Models\User;
use XS\BX24\Trial\Rest\RestClient;
use XS\BX24\Trial\Rest\TimeMan\TimeManClient;

class UserService
{

    private RestClient $client;
    private User $user;

    public function __construct(User $user, RestClient $client)
    {
        $this->user = $user;
        $this->client = $client;
    }


    public function isWorking()
    {
        return RestClient::timeman($this->client->getClient())->status($this->user->getBxId())->getResult()['STATUS'] === TimeManClient::STATUS['OPENED'];
    }

}