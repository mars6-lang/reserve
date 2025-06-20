<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class WeatherService
{
    /**
     * Fetch weather data from Open-Meteo API
     *
     * @param float $lat
     * @param float $lon
     * @return array
     */
    public function getWeather(float $lat = 52.52, float $lon = 13.41): array
    {
        $response = Http::get('https://api.open-meteo.com/v1/forecast', [
            'latitude' => $lat,
            'longitude' => $lon,
            'daily' => 'temperature_2m_max,daylight_duration,sunshine_duration,sunset,sunrise,rain_sum,showers_sum',
            'hourly' => 'temperature_2m,weather_code,rain,showers,cloud_cover_mid,cloud_cover_low,cloud_cover_high,cloud_cover,surface_pressure',
            'current' => 'is_day',
            'timezone' => 'auto'
        ]);

        // Return the API response in array format
        return $response->json();
    }
}