<?php

use Illuminate\Routing\Router;

$router->group(['prefix' => '/iquote/v1'], function (Router $router) {

  /*packages*/
  require ('ApiRoutes/packageRoutes.php');

  /*products*/
  require ('ApiRoutes/productRoutes.php');

  /*characteristics*/
  require ('ApiRoutes/characteristicRoutes.php');

  /*types*/
  require ('ApiRoutes/typeRoutes.php');

  /*quotes*/
  require ('ApiRoutes/quoteRoutes.php');

  /*packages-products*/
  require ('ApiRoutes/packageProductRoutes.php');

});
