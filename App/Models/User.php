<?php

namespace XS\BX24\Trial\Models;

class User
{
    private array $data = [
        'bx_id'               => 0,
        'last_lead_timestamp' => null,
    ];

    public function __construct(array $params = [])
    {
        foreach ($params as $k => $v) {
            $method = "set" . str_replace(' ', '', ucwords(str_replace('_', ' ', $k)));
            if (method_exists($this, $method)) {
                $this->$method($v);
            }
        }
    }

    public function setBxId(int $id): User
    {
        $this->data['bx_id'] = $id;
        return $this;
    }

    public function getBxId(): int
    {
        return $this->data['bx_id'];
    }

    public function setLastLeadTimestamp(int $timestamp)
    {
        $this->data['last_lead_timestamp'] = $timestamp;
        return $this;
    }

    public function getLastLeadTimestamp(): int
    {
        return $this->data['last_lead_timestamp'];
    }
}