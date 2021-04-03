<?php

namespace XS\BX24\Trial\Rest\Tasks;


use XS\BX24\Trial\Rest\RestClient;

class TaskClient extends RestClient
{

    public const METHODS = [
        'add' => 'tasks.task.add'
    ];


    public function add($params)
    {
        return $this->call(self::METHODS['add'], $params);
    }

}