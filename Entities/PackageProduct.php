<?php

namespace Modules\Iquote\Entities;

use Illuminate\Database\Eloquent\Model;

class PackageProduct extends Model
{
  protected $table = 'iquote__package_product';

  protected $fillable = [
    'product_id',
    'package_id',
  ];

  public function product()
  {
    return $this->belongsTo(Product::class, 'product_id');
  }

  public function package()
  {
    return $this->belongsTo(Package::class, 'package_id');
  }

}
