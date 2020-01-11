<?php

namespace Modules\Iquote\Transformers;

use Illuminate\Http\Resources\Json\Resource;
use Modules\Iquote\Helpers\Currency;
use Modules\User\Transformers\UserProfileTransformer;
use Modules\Iprofile\Transformers\UserTransformer;

class CurrencyTransformer extends Resource
{
  public function toArray($request)
  {
    $data = [
      'id' => $this->when($this->id, $this->id),
      'name' => $this->when($this->name, $this->name),
      'code' => $this->when($this->code, $this->code),
      'symbolLeft' => $this->when($this->symbol_left, $this->symbol_left),
      'symbolRight' => $this->when($this->symbol_right, $this->symbol_right),
      'decimalPlace' => $this->when($this->decimal_place, $this->decimal_place),
      'default_currency' => $this->default_currency ? true : false,
      'value' => $this->when($this->value, $this->value),
      'status' => $this->when($this->status, $this->status),
      'options' => $this->when($this->options, $this->options),
    ];
    return $data;
  }
}
