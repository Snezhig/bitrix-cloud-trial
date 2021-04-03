<?php


namespace XS\BX24\Trial\Console\Commands;


use XS\BX24\Trial\Console\CommandContract;
use XS\BX24\Trial\Rest\RestClient;
use XS\BX24\Trial\Service\LeadService;

class LeadGenerateCommand implements CommandContract
{

    public function __construct(array $arguments = [])
    {
    }

    public function handle()
    {
        (new LeadService(RestClient::crmLead()))->generate();
        echo "Done!\n";
    }


}