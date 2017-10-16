<?php
declare(strict_types=1);

namespace LuftsportvereinBacknangHeiningen\VereinsfliegerDeSdk\Application\Flight;

use GuzzleHttp\Promise\PromiseInterface;
use GuzzleHttp\Psr7\Request;
use LuftsportvereinBacknangHeiningen\VereinsfliegerDeSdk\Application\Flight\Data\FlightsData;
use LuftsportvereinBacknangHeiningen\VereinsfliegerDeSdk\Infrastructure\ApiClient;
use LuftsportvereinBacknangHeiningen\VereinsfliegerDeSdk\Infrastructure\AuthenticatedAccessTokenInterface as AuthenticatedAccessToken;

class FlightApiService
{
    private $apiClient;

    private $accessToken;

    public function __construct(ApiClient $apiClient, AuthenticatedAccessToken $accessToken)
    {
        $this->apiClient = $apiClient;
        $this->accessToken = $accessToken;
    }

    public function allFlightsDataOfDay(\DateTimeInterface $day): PromiseInterface
    {
        $promise =
            $this->apiClient->handleAsync(
                new Request(
                    'POST',
                    'interface/rest/flight/list/date',
                    ['Content-Type' => 'application/x-www-form-urlencoded'],
                    http_build_query(
                        [
                            'accesstoken' => (string) $this->accessToken,
                            'dateparam' => $day->format('Y-m-d')
                        ],
                        '',
                        '&'
                    )
                )
            );
        return $promise;
        // return FlightsData::fromJsonRepresentation((string)$response->getBody());
    }
}
