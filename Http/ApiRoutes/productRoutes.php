<?php

use Illuminate\Routing\Router;

$router->group(['prefix' => 'products'], function (Router $router) {
  $router->post('/', [
    'as' => 'api.iquote.products.create',
    'uses' => 'ProductApiController@create',
    'middleware' => ['auth:api']
  ]);
  $router->get('/', [
    'as' => 'api.iquote.products.index',
    'uses' => 'ProductApiController@index',
  ]);
  $router->get('/{criteria}', [
    'as' => 'api.iquote.products.show',
    'uses' => 'ProductApiController@show',
  ]);
  $router->put('/{criteria}', [
    'as' => 'api.iquote.products.update',
    'uses' => 'ProductApiController@update',
    'middleware' => ['auth:api']
  ]);
  $router->delete('/{criteria}', [
    'as' => 'api.iquote.products.delete',
    'uses' => 'ProductApiController@delete',
    'middleware' => ['auth:api']
  ]);
});
