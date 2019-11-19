<?php

use Illuminate\Routing\Router;

$router->group(['prefix' => 'packages'], function (Router $router) {
  $router->post('/', [
    'as' => 'api.iquote.packages.create',
    'uses' => 'PackageApiController@create',
    'middleware' => ['auth:api']
  ]);
  $router->get('/', [
    'as' => 'api.iquote.packages.index',
    'uses' => 'PackageApiController@index',
  ]);
  $router->get('/{criteria}', [
    'as' => 'api.iquote.packages.show',
    'uses' => 'PackageApiController@show',
  ]);
  $router->put('/{criteria}', [
    'as' => 'api.iquote.packages.update',
    'uses' => 'PackageApiController@update',
    'middleware' => ['auth:api']
  ]);
  $router->delete('/{criteria}', [
    'as' => 'api.iquote.packages.delete',
    'uses' => 'PackageApiController@delete',
    'middleware' => ['auth:api']
  ]);
});

