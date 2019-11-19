<?php

namespace Modules\Iquote\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Modules\Media\Entities\File;
use Modules\Media\Support\Traits\MediaRelation;

class Product extends Model
{
  use Translatable, MediaRelation;

  protected $table = 'iquote__products';

  public $translatedAttributes = [
    'name',
    'description',
  ];

  protected $fillable = [
    'active',
    'price',
  ];


  protected $casts = [
    'price' => 'integer'
  ];

  public function packages()
  {
    return $this->belongsToMany(Package::class, 'iquote__package_product');
  }

  public function characteristics()
  {
    return $this->hasMany(Characteristic::class);
  }

  public function getSecondaryImageAttribute()
  {
    $thumbnail = $this->files()->where('zone', 'secondaryimage')->first();
    if (!$thumbnail) {
      $image = [
        'mimeType' => 'image/jpeg',
        'path' => url('modules/iblog/img/post/default.jpg')
      ];
    } else {
      $image = [
        'mimeType' => $thumbnail->mimetype,
        'path' => $thumbnail->path_string
      ];
    }
    return json_decode(json_encode($image));
  }

  public function getMainImageAttribute()
  {
    $thumbnail = $this->files()->where('zone', 'mainimage')->first();
    if (!$thumbnail) {
      if (isset($this->options->mainimage)) {
        $image = [
          'mimeType' => 'image/jpeg',
          'path' => url($this->options->mainimage)
        ];
      } else {
        $image = [
          'mimeType' => 'image/jpeg',
          'path' => url('modules/iblog/img/post/default.jpg')
        ];
      }
    } else {
      $image = [
        'mimeType' => $thumbnail->mimetype,
        'path' => $thumbnail->path_string
      ];
    }
    return json_decode(json_encode($image));

  }

}
