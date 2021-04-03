<?php


namespace XS\BX24\Trial\Console;


interface CommandContract
{
    public function __construct(array $arguments = []);

    public function handle();
}