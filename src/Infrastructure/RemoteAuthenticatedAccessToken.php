<?php
declare(strict_types = 1);

namespace LuftsportvereinBacknangHeiningen\VereinsfliegerDeSdk\Infrastructure;

use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Uri;

class RemoteAuthenticatedAccessToken implements AuthenticatedAccessTokenInterface
{
    private const API_PATH_AUTH = 'interface/rest/auth/signin';

    /**
     * @var ApiClient
     */
    private $httpApiClient;

    /**
     * @var CredentialsInterface
     */
    private $credentials;

    /**
     * @var AccessTokenInterface
     */
    private $accessToken;

    public function __construct(
        ApiClient $apiClient,
        CredentialsInterface $credentials,
        AccessTokenInterface $accessToken
    ) {
        $this->accessToken = $accessToken;
        $this->credentials = $credentials;
        $this->httpApiClient = $apiClient;

        $this->authenticate();
    }

    private function authenticate()
    {
        $this->httpApiClient->handle(
            new Request(
                'POST',
                (new Uri(self::API_PATH_AUTH))
                    ->withQuery(http_build_query([
                        'accesstoken' => (string) $this->accessToken,
                        'username' => $this->credentials->username(),
                        'password' => md5($this->credentials->password())
                    ]))
            )
        );
    }

    public function __toString(): string
    {
        return (string) $this->accessToken;
    }
}
