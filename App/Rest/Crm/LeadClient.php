<?php


namespace XS\BX24\Trial\Rest\Crm;


use XS\BX24\Trial\Rest\RestClient;

class LeadClient extends RestClient
{
    const METHODS = [
        'list' => 'crm.lead.list',
        'add'  => 'crm.lead.add'
    ];


    public function add($params)
    {
        return $this->call(self::METHODS['add'], $params);
    }
}