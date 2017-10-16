<?php
declare(strict_types = 1);

namespace LuftsportvereinBacknangHeiningen\VereinsfliegerDeSdk\Infrastructure;

use GuzzleHttp\Client;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class ApiClient
{
    private const BASE_URI = 'https://www.vereinsflieger.de/';

    /**
     * @var Client
     */
    private $lowlevelHttpClient;

    public function __construct()
    {
        $this->lowlevelHttpClient = new Client([
            'base_uri' => self::BASE_URI
        ]);
    }

    public function handle(RequestInterface $request): ResponseInterface
    {
        return $this->lowlevelHttpClient->send($request);
    }

    public function handleAsync(RequestInterface $request): \GuzzleHttp\Promise\PromiseInterface
    {
        return $this->lowlevelHttpClient->sendAsync($request);
    }
}
