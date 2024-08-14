<?php

require __DIR__ . '/vendor/autoload.php';

$dotEnvPath = __DIR__;
\Dotenv\Dotenv::createImmutable($dotEnvPath)->load();

use App\Service\ReverseGeocode\Geoapify;

$reverseGeocoder = new Geoapify();

echo $reverseGeocoder->getAddress(-23.6882709356927, -46.68384334949678) . PHP_EOL;