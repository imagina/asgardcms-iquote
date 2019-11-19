<?php

namespace Modules\Iquote\Entities;

use Illuminate\Database\Eloquent\Model;

class PackageTranslation extends Model
{
    public $timestamps = false;

    protected $fillable = [
      'name',
      'description',
      'package_id',
      'locale',
      'package_id',
    ];

    protected $table = 'iquote__package_translations';
}
