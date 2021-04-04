<?php


namespace XS\BX24\Trial\Rest\Lists;


class ElementClient extends \XS\BX24\Trial\Rest\RestClient
{
    const METHODS = [
        'add' => 'lists.element.add'
    ];


    public function add($params)
    {
        return $this->call(self::METHODS['add'], $params);
    }
}