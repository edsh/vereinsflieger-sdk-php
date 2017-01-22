<?php
require __DIR__ . '/vendor/autoload.php';

use LuftsportvereinBacknangHeiningen\VereinsfliegerDeSdk\Infrastructure\ApiClient;
use LuftsportvereinBacknangHeiningen\VereinsfliegerDeSdk\Infrastructure\RemoteAccessToken;

$apiClient = new ApiClient();

$accessToken = new RemoteAccessToken($apiClient);

echo 'Token:' . $accessToken;
