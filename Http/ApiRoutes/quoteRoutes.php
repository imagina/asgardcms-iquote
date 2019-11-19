<?php

use Illuminate\Routing\Router;

$router->group(['prefix' => 'quotes'], function (Router $router) {
  $router->post('/', [
    'as' => 'api.iquote.quotes.create',
    'uses' => 'QuoteApiController@create',
    'middleware' => ['auth:api']
  ]);
  $router->get('/', [
    'as' => 'api.iquote.quotes.index',
    'uses' => 'QuoteApiController@index',
  ]);
  $router->get('/{criteria}', [
    'as' => 'api.iquote.quotes.show',
    'uses' => 'QuoteApiController@show',
  ]);
  $router->put('/{criteria}', [
    'as' => 'api.iquote.quotes.update',
    'uses' => 'QuoteApiController@update',
    'middleware' => ['auth:api']
  ]);
  $router->delete('/{criteria}', [
    'as' => 'api.iquote.quotes.delete',
    'uses' => 'QuoteApiController@delete',
    'middleware' => ['auth:api']
  ]);
});
