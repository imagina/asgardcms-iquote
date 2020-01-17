<?php

use Illuminate\Routing\Router;

$router->group(['prefix' => 'configs'], function (Router $router) {
  $router->get('/', [
    'as' => 'api.iquote.configs.index',
    'uses' => 'ConfigApiController@index',
  ]);
});
