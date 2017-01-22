<?php
require __DIR__ . '/vendor/autoload.php';

use LuftsportvereinBacknangHeiningen\VereinsfliegerDeSdk\Port\Adapter\ApiClient;
use LuftsportvereinBacknangHeiningen\VereinsfliegerDeSdk\Port\Adapter\RemoteAccessToken;

$apiClient = new ApiClient();

$accessToken = new RemoteAccessToken($apiClient);

echo 'Token:' . $accessToken;
