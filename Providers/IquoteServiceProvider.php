<?php

namespace Modules\Iquote\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Core\Traits\CanPublishConfiguration;
use Modules\Core\Events\BuildingSidebar;
use Modules\Core\Events\LoadingBackendTranslations;
use Modules\Iquote\Events\Handlers\RegisterIquoteSidebar;

class IquoteServiceProvider extends ServiceProvider
{
    use CanPublishConfiguration;
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerBindings();
        $this->app['events']->listen(BuildingSidebar::class, RegisterIquoteSidebar::class);

        $this->app['events']->listen(LoadingBackendTranslations::class, function (LoadingBackendTranslations $event) {
            $event->load('packages', array_dot(trans('iquote::packages')));
            $event->load('products', array_dot(trans('iquote::products')));
            $event->load('characteristics', array_dot(trans('iquote::characteristics')));
            $event->load('types', array_dot(trans('iquote::types')));
            $event->load('quotes', array_dot(trans('iquote::quotes')));
            // append translations





        });
    }

    public function boot()
    {
        $this->publishConfig('iquote', 'permissions');

        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array();
    }

    private function registerBindings()
    {
        $this->app->bind(
            'Modules\Iquote\Repositories\PackageRepository',
            function () {
                $repository = new \Modules\Iquote\Repositories\Eloquent\EloquentPackageRepository(new \Modules\Iquote\Entities\Package());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Iquote\Repositories\Cache\CachePackageDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Iquote\Repositories\ProductRepository',
            function () {
                $repository = new \Modules\Iquote\Repositories\Eloquent\EloquentProductRepository(new \Modules\Iquote\Entities\Product());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Iquote\Repositories\Cache\CacheProductDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Iquote\Repositories\CharacteristicRepository',
            function () {
                $repository = new \Modules\Iquote\Repositories\Eloquent\EloquentCharacteristicRepository(new \Modules\Iquote\Entities\Characteristic());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Iquote\Repositories\Cache\CacheCharacteristicDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Iquote\Repositories\TypeRepository',
            function () {
                $repository = new \Modules\Iquote\Repositories\Eloquent\EloquentTypeRepository(new \Modules\Iquote\Entities\Type());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Iquote\Repositories\Cache\CacheTypeDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Iquote\Repositories\QuoteRepository',
            function () {
                $repository = new \Modules\Iquote\Repositories\Eloquent\EloquentQuoteRepository(new \Modules\Iquote\Entities\Quote());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Iquote\Repositories\Cache\CacheQuoteDecorator($repository);
            }
        );
        $this->app->bind(
          'Modules\Iquote\Repositories\PackageProductRepository',
          function () {
            $repository = new \Modules\Iquote\Repositories\Eloquent\EloquentPackageProductRepository(new \Modules\Iquote\Entities\PackageProduct());

            if (! config('app.cache')) {
              return $repository;
            }

            return new \Modules\Iquote\Repositories\Cache\CachePackageProductDecorator($repository);
          }
      );
// add bindings





    }
}
