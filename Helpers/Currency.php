<?php

namespace Modules\Iquote\Helpers;

use Modules\Iquote\Entities\Currency as CurrencyEntity;

class Currency
{

  /**
   * @var
   */
  protected $localeCurency;

  /**
   * Currency constructor.
   */
  public function __construct()
  {
    /* Init locale Currency with default value 'AUD'*/
    $this->localeCurency = CurrencyEntity::where('code', 'AUD')->first();
  }

  /**
   * @param $value
   * @return float
   */
  public function convert($value)
  {
    /*
     * calculate value,
     * from the default currency
     * to the local currency of the app
     */
    $result = floatval($value) / floatval($this->localeCurency->value ?? 1);

    /* Return value in the follow formant 'xxxx.xx' */
    return  $this->trasformerResult($result);
  }

  /**
   * @param $value
   * @param $to
   * @param $from
   * @return float
   */
  public function convertFromTo($value, $to, $from = 'AUD')
  {
    /* Convert value from currency "From" */
    $fromCurrency = CurrencyEntity::where('code', $from)->first();
    $fromCurrencyValue = intval($value) * ($fromCurrency->value ?? 1);

    /* Convert value from currency "to" */
    $toCurrency = CurrencyEntity::where('code', $to)->first();
    $toCurrencyValue = $this->trasformerResult($fromCurrencyValue) / ($toCurrency->value ?? 1);

    /* Return value in the follow formant 'xxxx.xx' */
    return  $this->trasformerResult($toCurrencyValue);
  }


  /**
   * @return mixed
   */
  public function getLocaleCurency()
  {
    return $this->localeCurency->code;
  }

  /**
   * @param $localeCurency
   */
  public function setLocaleCurency($localeCurency)
  {
    $this->localeCurency = CurrencyEntity::where('code', strtoupper($localeCurency))->first();
  }

  /**
   * @param $result
   * @return float
   */
  private function trasformerResult ($result ){
    return floatval(number_format($result, 2, '.', ''));
  }

}
