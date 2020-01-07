<?php

namespace Modules\Iquote\Entities;

use Illuminate\Database\Eloquent\Model;

class ProductTranslation extends Model
{
    public $timestamps = false;

    protected $fillable = [
      'name',
      'description',
      'product_id',
      'locale',
    ];
    protected $table = 'iquote__product_translations';
}
