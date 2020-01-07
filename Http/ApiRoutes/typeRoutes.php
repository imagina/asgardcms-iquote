<?php

use Illuminate\Routing\Router;

$router->group(['prefix' => 'types'], function (Router $router) {
  $router->get('/', [
    'as' => 'api.iquote.types.index',
    'uses' => 'TypeApiController@index',
  ]);
});
