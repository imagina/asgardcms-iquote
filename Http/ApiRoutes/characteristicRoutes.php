<?php

use Illuminate\Routing\Router;
use Modules\Iquote\Facades\Currency;

$router->group(['prefix' => 'characteristics'], function (Router $router) {

  $router->post('/', [
    'as' => 'api.iquote.characteristics.create',
    'uses' => 'CharacteristicApiController@create',
    'middleware' => ['auth:api']
  ]);
  $router->post('/characteristics-order', [
    'as' => 'api.iquote.characteristics.order',
    'uses' => 'CharacteristicApiController@updateOrder',
    'middleware' => ['auth:api']
  ]);
  $router->get('/', [
    'as' => 'api.iquote.characteristics.index',
    'uses' => 'CharacteristicApiController@index',
  ]);
  $router->get('/{criteria}', [
    'as' => 'api.iquote.characteristics.show',
    'uses' => 'CharacteristicApiController@show',
  ]);
  $router->put('/{criteria}', [
    'as' => 'api.iquote.characteristics.update',
    'uses' => 'CharacteristicApiController@update',
    'middleware' => ['auth:api']
  ]);
  $router->delete('/{criteria}', [
    'as' => 'api.iquote.characteristics.delete',
    'uses' => 'CharacteristicApiController@delete',
    'middleware' => ['auth:api']
  ]);
});
