<?php

namespace Modules\Iquote\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
  use Translatable;

  protected $table = 'iquote__packages';

  public $translatedAttributes = [
    'name',
    'description',
    'package_id',
  ];

  protected $fillable = [];

  public function products()
  {
    return $this->belongsToMany(Product::class, 'iquote__package_product');
  }

}
