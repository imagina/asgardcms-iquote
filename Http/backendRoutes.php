<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'/iquote'], function (Router $router) {
    $router->bind('package', function ($id) {
        return app('Modules\Iquote\Repositories\PackageRepository')->find($id);
    });
    $router->get('packages', [
        'as' => 'admin.iquote.package.index',
        'uses' => 'PackageController@index',
        'middleware' => 'can:iquote.packages.index'
    ]);
    $router->get('packages/create', [
        'as' => 'admin.iquote.package.create',
        'uses' => 'PackageController@create',
        'middleware' => 'can:iquote.packages.create'
    ]);
    $router->post('packages', [
        'as' => 'admin.iquote.package.store',
        'uses' => 'PackageController@store',
        'middleware' => 'can:iquote.packages.create'
    ]);
    $router->get('packages/{package}/edit', [
        'as' => 'admin.iquote.package.edit',
        'uses' => 'PackageController@edit',
        'middleware' => 'can:iquote.packages.edit'
    ]);
    $router->put('packages/{package}', [
        'as' => 'admin.iquote.package.update',
        'uses' => 'PackageController@update',
        'middleware' => 'can:iquote.packages.edit'
    ]);
    $router->delete('packages/{package}', [
        'as' => 'admin.iquote.package.destroy',
        'uses' => 'PackageController@destroy',
        'middleware' => 'can:iquote.packages.destroy'
    ]);
    $router->bind('product', function ($id) {
        return app('Modules\Iquote\Repositories\ProductRepository')->find($id);
    });
    $router->get('products', [
        'as' => 'admin.iquote.product.index',
        'uses' => 'ProductController@index',
        'middleware' => 'can:iquote.products.index'
    ]);
    $router->get('products/create', [
        'as' => 'admin.iquote.product.create',
        'uses' => 'ProductController@create',
        'middleware' => 'can:iquote.products.create'
    ]);
    $router->post('products', [
        'as' => 'admin.iquote.product.store',
        'uses' => 'ProductController@store',
        'middleware' => 'can:iquote.products.create'
    ]);
    $router->get('products/{product}/edit', [
        'as' => 'admin.iquote.product.edit',
        'uses' => 'ProductController@edit',
        'middleware' => 'can:iquote.products.edit'
    ]);
    $router->put('products/{product}', [
        'as' => 'admin.iquote.product.update',
        'uses' => 'ProductController@update',
        'middleware' => 'can:iquote.products.edit'
    ]);
    $router->delete('products/{product}', [
        'as' => 'admin.iquote.product.destroy',
        'uses' => 'ProductController@destroy',
        'middleware' => 'can:iquote.products.destroy'
    ]);
    $router->bind('characteristic', function ($id) {
        return app('Modules\Iquote\Repositories\CharacteristicRepository')->find($id);
    });
    $router->get('characteristics', [
        'as' => 'admin.iquote.characteristic.index',
        'uses' => 'CharacteristicController@index',
        'middleware' => 'can:iquote.characteristics.index'
    ]);
    $router->get('characteristics/create', [
        'as' => 'admin.iquote.characteristic.create',
        'uses' => 'CharacteristicController@create',
        'middleware' => 'can:iquote.characteristics.create'
    ]);
    $router->post('characteristics', [
        'as' => 'admin.iquote.characteristic.store',
        'uses' => 'CharacteristicController@store',
        'middleware' => 'can:iquote.characteristics.create'
    ]);
    $router->get('characteristics/{characteristic}/edit', [
        'as' => 'admin.iquote.characteristic.edit',
        'uses' => 'CharacteristicController@edit',
        'middleware' => 'can:iquote.characteristics.edit'
    ]);
    $router->put('characteristics/{characteristic}', [
        'as' => 'admin.iquote.characteristic.update',
        'uses' => 'CharacteristicController@update',
        'middleware' => 'can:iquote.characteristics.edit'
    ]);
    $router->delete('characteristics/{characteristic}', [
        'as' => 'admin.iquote.characteristic.destroy',
        'uses' => 'CharacteristicController@destroy',
        'middleware' => 'can:iquote.characteristics.destroy'
    ]);
    $router->bind('type', function ($id) {
        return app('Modules\Iquote\Repositories\TypeRepository')->find($id);
    });
    $router->get('types', [
        'as' => 'admin.iquote.type.index',
        'uses' => 'TypeController@index',
        'middleware' => 'can:iquote.types.index'
    ]);
    $router->get('types/create', [
        'as' => 'admin.iquote.type.create',
        'uses' => 'TypeController@create',
        'middleware' => 'can:iquote.types.create'
    ]);
    $router->post('types', [
        'as' => 'admin.iquote.type.store',
        'uses' => 'TypeController@store',
        'middleware' => 'can:iquote.types.create'
    ]);
    $router->get('types/{type}/edit', [
        'as' => 'admin.iquote.type.edit',
        'uses' => 'TypeController@edit',
        'middleware' => 'can:iquote.types.edit'
    ]);
    $router->put('types/{type}', [
        'as' => 'admin.iquote.type.update',
        'uses' => 'TypeController@update',
        'middleware' => 'can:iquote.types.edit'
    ]);
    $router->delete('types/{type}', [
        'as' => 'admin.iquote.type.destroy',
        'uses' => 'TypeController@destroy',
        'middleware' => 'can:iquote.types.destroy'
    ]);
    $router->bind('quote', function ($id) {
        return app('Modules\Iquote\Repositories\QuoteRepository')->find($id);
    });
    $router->get('quotes', [
        'as' => 'admin.iquote.quote.index',
        'uses' => 'QuoteController@index',
        'middleware' => 'can:iquote.quotes.index'
    ]);
    $router->get('quotes/create', [
        'as' => 'admin.iquote.quote.create',
        'uses' => 'QuoteController@create',
        'middleware' => 'can:iquote.quotes.create'
    ]);
    $router->post('quotes', [
        'as' => 'admin.iquote.quote.store',
        'uses' => 'QuoteController@store',
        'middleware' => 'can:iquote.quotes.create'
    ]);
    $router->get('quotes/{quote}/edit', [
        'as' => 'admin.iquote.quote.edit',
        'uses' => 'QuoteController@edit',
        'middleware' => 'can:iquote.quotes.edit'
    ]);

    $router->put('quotes/{quote}', [
        'as' => 'admin.iquote.quote.update',
        'uses' => 'QuoteController@update',
        'middleware' => 'can:iquote.quotes.edit'
    ]);
    $router->delete('quotes/{quote}', [
        'as' => 'admin.iquote.quote.destroy',
        'uses' => 'QuoteController@destroy',
        'middleware' => 'can:iquote.quotes.destroy'
    ]);
// append





});
