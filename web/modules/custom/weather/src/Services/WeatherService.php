<?php

namespace  Drupal\weather\Services;

use Guzzle\Http\Client;
use Symfony\Component\HttpFoundation\RequestStack;
//implements CustomDecoratorInterface
class WeatherService   {
// /**
//    * Request stack object.
//    *
//    * @var \Symfony\Component\HttpFoundation\RequestStack
//    */
//   protected $requestStack;
//   /**
//    * OriginalService constructor.
//    *
//    * @param \Symfony\Component\HttpFoundation\RequestStack $request_stack
//    */
//   public function __construct(RequestStack $request_stack) {
//     $this->requestStack = $request_stack;
//   }
//   public function helper() {
//     $uri = $this->requestStack->getCurrentRequest()->getRequestUri();
//     return t('current page uri: :uri', [':uri' => $uri]); 
//   }

    function getWeatherData($city)
    {
        $config = \Drupal::config('weather.settings');
        $appid= $config->get('app');
        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', 'https://samples.openweathermap.org/data/2.5/weather?q='.$city.'&appid='.$appid);
        return $response->getBody();
    }
}