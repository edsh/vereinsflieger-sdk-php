<?php
declare(strict_types = 1);

namespace LuftsportvereinBacknangHeiningen\VereinsfliegerDeSdk\Infrastructure;

use Assert\Assertion;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Psr7\Request;

class RemoteAccessToken implements AccessTokenInterface
{
    private const API_PATH = 'interface/rest/auth/accesstoken';

    /**
     * @var ClientInterface
     */
    private $httpApiClient;

    private $token;

    public function __construct(ApiClient $httpApiClient)
    {
        $this->httpApiClient = $httpApiClient;
    }

    public function __toString(): string
    {
        return $this->token();
    }

    private function token(): string
    {
        if ($this->token === null) {
            $this->token = $this->fetchToken();
        }
        return $this->token;
    }

    private function fetchToken(): string
    {
        $response =
            $this->httpApiClient->handle(
                new Request(
                    'GET',
                    self::API_PATH
                )
            );
        $json = json_decode((string) $response->getBody(), true);
        Assertion::keyExists($json, 'accesstoken');

        return $json['accesstoken'];
    }
}
