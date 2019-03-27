<?php

namespace  Drupal\weather\Services;

use Guzzle\Http\Client;

class WeatherService{
    function get_weather_data($city)
    {
        $config = \Drupal::config('weather.settings');
        $appid= $config->get('app');
        //debug($appid, '$appid');
        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', 'https://samples.openweathermap.org/data/2.5/weather?q='.$city.'&appid='.$appid);
        return $response->getBody();
    }
}
?>