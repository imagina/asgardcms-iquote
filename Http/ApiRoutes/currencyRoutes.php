<?php

use Illuminate\Routing\Router;

$router->group(['prefix' => 'currencies'], function (Router $router) {
  $router->get('/', [
    'as' => 'api.iquote.currencies.index',
    'uses' => 'CurrencyApiController@index',
  ]);
});
