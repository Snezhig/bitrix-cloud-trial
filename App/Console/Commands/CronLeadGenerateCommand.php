<?php


namespace XS\BX24\Trial\Console\Commands;


use XS\BX24\Trial\Database\Connection;
use XS\BX24\Trial\Rest\RestClient;
use XS\BX24\Trial\Service\LeadService;

class CronLeadGenerateCommand implements \XS\BX24\Trial\Console\CommandContract
{

    public function __construct(array $arguments = [])
    {
    }

    //Very dirty.
    public function handle()
    {
        if (getenv('ENABLE_LEAD_AUTOGENERATE') !== 'Y') {
            return;
        }
        $pdo = Connection::getInstance()->pdo();
        $stmt = $pdo->prepare('SELECT * FROM cron_tasks WHERE "name" = "lead_generate"');
        $stmt->execute();
        $row = $stmt->fetch();
        if ($row === false) {
            $stmt = $pdo->prepare('INSERT INTO cron_tasks VALUES (?, ?, ?)');
            $stmt->execute([
                'lead_generate',
                (new \DateTime())->getTimestamp(),
                (new \DateTime())->getTimestamp(),
            ]);
            sleep(1);
            $this->handle();
        } else if ($row['next'] < (new \DateTime())->getTimestamp()) {
            $result = (new LeadService(RestClient::crmLead()))->generate();
            if ($result === false) {
                echo "\nLead has not been created\n";
            } else {
                $stmt = $pdo->prepare('UPDATE cron_tasks SET "next" = :nt, executed = :ct WHERE name = "lead_generate"');
                $stmt->execute([
                    ':nt' => (new \DateTime())->add(date_interval_create_from_date_string(rand(1, 10) . ' minutes'))->getTimestamp(),
                    ':ct' => (new \DateTime())->getTimestamp()
                ]);
                echo "\nLead has been created\n";
            }
        } else {
            echo "\nToo early\n";
        }
    }
}