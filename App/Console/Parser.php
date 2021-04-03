<?php

namespace XS\BX24\Trial\Console;

class Parser
{
    private $command, $arguments;

    private const PREFIX = __NAMESPACE__ . '\\Commands\\';
    private const SUFFIX = 'Command';

    public function __construct()
    {
        $this->parse();
    }

    private function parse()
    {
        $this->command = (string)$GLOBALS['argv'][1];
        $this->arguments = array_slice($GLOBALS['argv'], 2);
    }

    /**
     * @return mixed
     */
    public function getArguments()
    {
        return $this->arguments;
    }

    /**
     * @return mixed
     */
    public function getCommand()
    {
        return $this->command;
    }

    public function getCommandClassName(): string
    {
        $className = str_replace(' ', '', ucwords(str_replace(['-', '_', ':'], ' ', $this->getCommand())));
        return self::PREFIX . $className . self::SUFFIX;
    }
}