<?php

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Request;
use Modules\Ihelpers\Http\Controllers\Api\BaseApiController;
/** @var Router $router */

$router->group(['prefix' =>'/quotes'], function (Router $router) {
    $router->bind('quote', function ($id) {
      $quote =  app('Modules\Iquote\Repositories\QuoteRepository')->find($id);
      return $quote;
    });

    $router->get('{quote}/pdf', [
      'as' =>  'iquote.pdf',
      'uses' => 'PublicController@downloadQuote'
    ]);

    $router->get('{quote}/show', [
      'as' =>  'iquote.show',
      'uses' => 'PublicController@showQuoteHTML'
    ]);


});
