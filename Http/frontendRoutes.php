<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'/quotes'], function (Router $router) {
    $router->bind('quote', function ($id) {
      return app('Modules\Iquote\Repositories\QuoteRepository')->find($id);
    });

    $router->get('{quote}/pdf', [
      'as' =>  'iquote.pdf',
      'uses' => 'PublicController@downloadQuote'
    ]);


});
