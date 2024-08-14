<?php

namespace App\Service\ReverseGeocode\Interface;
interface ReverseGeocodeInterface
{
    public function getAddress(float $latitude, float $longitude): string;
}