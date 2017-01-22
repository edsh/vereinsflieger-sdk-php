<?php
declare(strict_types = 1);

namespace LuftsportvereinBacknangHeiningen\VereinsfliegerDeSdk\Port\Adapter;

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
