<?php


namespace XS\BX24\Trial\Rest\Crm;


class QuoteClient extends \XS\BX24\Trial\Rest\RestClient
{

    public const METHODS = [
        'add' => 'crm.quote.add'
    ];


    public function add($params)
    {
        return $this->call(self::METHODS['add'], $params);
    }

}