<?php

namespace Modules\Iquote\Facades;

use Illuminate\Support\Facades\Facade;

class CurrencyFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'currency';
    }
}
