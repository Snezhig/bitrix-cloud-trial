<?php
namespace XS\BX24\Trial\Service;


use XS\BX24\Trial\Models\User;
use XS\BX24\Trial\Rest\RestClient;

class TaskService
{
    private RestClient $client;

    public function __construct(RestClient $client)
    {
        $this->client = $client;
    }

    public function createForLead(int $leadId, User $user){
        return RestClient::tasksTask($this->client->getClient())->add([
            'fields' => [
                'TITLE' => "Связаться с клиентом",
                'UF_CRM_TASK' => ["L_$leadId"],
                'RESPONSIBLE_ID' => $user->getBxId()
            ]
        ])->getResult();
    }
}