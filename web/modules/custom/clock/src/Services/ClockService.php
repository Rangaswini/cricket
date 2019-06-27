<?php

namespace  Drupal\clock\Services;

use Guzzle\Http\Client;
class ClockService   {
  function getData($zone)  {
    $config = \Drupal::config('clock.settings');
    $client = new \GuzzleHttp\Client();
    if($zone == 'EST')  {
      $response = $client->request('GET', 'http://worldclockapi.com/api/json/est/now');
    }
    else  {
      $response = $client->request('GET', 'http://worldclockapi.com/api/json/utc/now');
    }
    return $response->getBody();
    }
}