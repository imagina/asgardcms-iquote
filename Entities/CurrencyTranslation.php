<?php

namespace Modules\Iquote\Entities;

use Illuminate\Database\Eloquent\Model;

class CurrencyTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = [
      'name'
    ];
    protected $table = 'iquote__currency_translations';
}
