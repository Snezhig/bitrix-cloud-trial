<?php


namespace XS\BX24\Trial\Rest;


use GuzzleHttp\Psr7\Request;
use GuzzleHttp\RequestOptions;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class Response implements iResponse
{
    private \GuzzleHttp\Client $client;
    private RequestInterface $request;
    private ResponseInterface $response;
    private array $options;
    private ?array $answer = null;

    public function __construct(\GuzzleHttp\Client $client, RequestInterface $request, array $options = [])
    {
        $this->client = $client;
        $this->request = $request;
        $this->options = $options;

        $this->response = $client->send($request, $options);
    }


    public function getAnswer(): ?array
    {
        if (is_null($this->answer)) {
            $this->answer = json_decode($this->response->getBody()->read($this->response->getBody()->getSize()), true);
        }
        return $this->answer;
    }

    public function getResult()
    {
        return $this->getAnswer()['result'];
    }

    public function hasMore(): bool
    {
        return (int)$this->getAnswer()['next'] > 0;
    }

    public function getTotal(): int
    {
        return (int)$this->getAnswer()['total'];
    }

    public function getCount(): int
    {
        return count($this->getResult());
    }


    public function getTime(): array
    {
        return $this->getAnswer()['time'];
    }

    public function next(): iResponse
    {
        if ($this->hasMore()) {
            $this->options[RequestOptions::JSON]['start'] = $this->getAnswer()['next'];
            $this->response = $this->client->send(new Request('POST', $this->request->getUri()->__toString()), $this->options);
            $this->answer = null;
        }
        return $this;
    }
}