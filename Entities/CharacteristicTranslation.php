<?php

namespace Modules\Iquote\Entities;

use Illuminate\Database\Eloquent\Model;

class CharacteristicTranslation extends Model
{
    public $timestamps = false;

    protected $fillable = [
      'name',
      'description',
      'options',
      'characteristic_id',
      'locale',
    ];

    protected $table = 'iquote__characteristic_translations';
}
