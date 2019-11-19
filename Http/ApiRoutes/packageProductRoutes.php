<?php

use Illuminate\Routing\Router;

$router->group(['prefix' => 'packages-products'], function (Router $router) {
  $router->post('/', [
    'as' => 'api.iquote.packages.products.create',
    'uses' => 'PackageProductApiController@create',
    'middleware' => ['auth:api']
  ]);
  $router->get('/', [
    'as' => 'api.iquote.packages.products.index',
    'uses' => 'PackageProductApiController@index',
  ]);
  $router->get('/{criteria}', [
    'as' => 'api.iquote.packages.products.show',
    'uses' => 'PackageProductApiController@show',
  ]);
  $router->put('/{criteria}', [
    'as' => 'api.iquote.packages.products.update',
    'uses' => 'PackageProductApiController@update',
    'middleware' => ['auth:api']
  ]);
  $router->delete('/{criteria}', [
    'as' => 'api.iquote.packages.products.delete',
    'uses' => 'PackageProductApiController@delete',
    'middleware' => ['auth:api']
  ]);
});

