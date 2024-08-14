<?php

namespace App\Service\ReverseGeocode;
use App\Service\ReverseGeocode\Interface\ReverseGeocodeInterface;

class Geoapify implements ReverseGeocodeInterface
{
    private const baseUrl = 'https://api.geoapify.com/v1/geocode/reverse';
    public function getAddress(float $latitude, float $longitude): string
    {
        $curl = $this->prepareHttpRequest($latitude, $longitude);
        $response = $this->makeHttpRequest($curl);
        return $response->results[0]->formatted;
    }

    private function prepareHttpRequest(float $latitude, float $longitude): \CurlHandle
    {
        $curl = curl_init();
        $apiParameters = [
            'lat' => $latitude,
            'lon' => $longitude,
            'apiKey' => $_ENV['API_TOKEN'],
            'format' => 'json'
        ];
        curl_setopt_array($curl, [
            CURLOPT_URL => self::baseUrl . '?' . http_build_query($apiParameters),
            CURLOPT_RETURNTRANSFER => true,
        ]);

        return $curl;
    }

    private function makeHttpRequest(\CurlHandle $curl): \StdClass
    {
        return json_decode(curl_exec($curl));
    }
}