<?php


namespace XS\BX24\Trial\Rest;


interface iResponse
{
    public function getAnswer(): ?array;

    /**
     * @return mixed
     */
    public function getResult();

    public function hasMore(): bool;

    public function getTotal(): int;

    public function getCount(): int;

    public function getTime(): array;

    public function next(): iResponse;
}