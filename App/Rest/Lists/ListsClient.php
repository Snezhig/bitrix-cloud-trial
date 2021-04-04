<?php


namespace XS\BX24\Trial\Rest\Lists;


use XS\BX24\Trial\Rest\RestClient;

class ListsClient extends RestClient
{

    const METHODS = [
        'get' => 'lists.get',
        'add' => 'lists.add'
    ];


    public function add($params)
    {
        return $this->call(self::METHODS['add'], $params);
    }

    public function get($params)
    {
        return $this->call(self::METHODS['get'], $params);
    }

}