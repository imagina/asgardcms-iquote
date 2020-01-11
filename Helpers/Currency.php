<?php

namespace Modules\Iquote\Helpers;

use Modules\Iquote\Entities\Currency as CurrencyEntity;

class Currency
{
    /**
     * @param $value
     * @param $to
     * @return float
     */
    public static function convert($value, $to)
    {
        /* Get data currency from database */
        $currencyEntity = CurrencyEntity::where('code', strtoupper($to))->first();

        /* Calc param 'value' to currency */
        $transformedValue = intval($value) / ($currencyEntity->value ?? 1);

        /* Return value in the follow formant 'xxxx.xx' */
        return  floatval(number_format($transformedValue, 2, '.', ''));
    }
}
