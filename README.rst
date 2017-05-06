Vereinsflieger.de-SDK für PHP
=============================

Diese Library stellt Funktionalitäten für die Arbeit insbesondere mit der REST-Schnittstelle
von vereinsflieger.de zur Verfügung.

Installation
------------

Die Installation erfolgt wie üblich mittels Composer::

    composer require edsh/vereinsflieger-sdk-php

Verwendung
----------

Beispiel 1: Export-CSV für den Import von Flügen ins AME Avia durchführen::

    <?php
    declare(strict_types = 1);

    use \LuftsportvereinBacknangHeiningen\VereinsfliegerDeSdk\Infrastructure\ApiClient;
    use \LuftsportvereinBacknangHeiningen\VereinsfliegerDeSdk\Infrastructure\RemoteAuthenticatedAccessToken;
    use \LuftsportvereinBacknangHeiningen\VereinsfliegerDeSdk\Infrastructure\DefaultCredentials;
    use \LuftsportvereinBacknangHeiningen\VereinsfliegerDeSdk\Infrastructure\RemoteAccessToken;
    use \LuftsportvereinBacknangHeiningen\VereinsfliegerDeSdk\Application\Flight\FlightApiService;
    use \LuftsportvereinBacknangHeiningen\VereinsfliegerDeSdk\Port\Adapter\Service\AmeAviaFlightDataCsvAdapter;

    $apiClient = new ApiClient();

    $accessToken =
        new RemoteAuthenticatedAccessToken(
            $apiClient,
            new DefaultCredentials(getenv('VF_USERNAME'), getenv('VF_PASSWORD')),
            new RemoteAccessToken($apiClient)
        );

    $queryService =
        new FlightApiService($apiClient, $accessToken);
    $flightsToday =
        $queryService
            ->allFlightsDataOfDay(
                \DateTimeImmutable::createFromFormat(
                    'Y-m-d',
                    $input->getArgument('date')
                )
            );
    foreach ($flightsToday as $flightData) {
        $csv =
            new EdshAmeFlightDataCsvAdapter(
                new AmeAviaFlightDataCsvAdapter($flightData)
            );
        $output->writeln((string) $csv);
    }
