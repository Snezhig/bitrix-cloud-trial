<?php

namespace XS\BX24\Trial\Rest\TimeMan;

use XS\BX24\Trial\Rest\RestClient;
use XS\BX24\Trial\Rest\iResponse;

class TimeManClient extends RestClient
{
    const METHODS = [
        'status' => 'timeman.status',
    ];

    const STATUS = [
        'OPENED'  => 'OPENED',
        'CLOSED'  => 'CLOSED',
        'PAUSED'  => 'PAUSED',
        'EXPIRED' => 'EXPIRED'
    ];


    public function status($userId): iResponse
    {
        return $this->call(self::METHODS['status'], ['USER_ID' => $userId]);
    }

}