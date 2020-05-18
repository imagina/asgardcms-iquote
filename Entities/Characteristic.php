<?php

namespace Modules\Iquote\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;
use Modules\Iquote\Presenters\CharacteristicPresenter;
use Modules\Media\Entities\File;
use Modules\Media\Support\Traits\MediaRelation;

class Characteristic extends Model
{
  use Translatable, PresentableTrait, MediaRelation;

  protected $table = 'iquote__characteristics';

  public $translatedAttributes = [
    'name',
    'description',
    'options',
  ];

  protected $fillable = [
    'product_id',
    'type',
    'parent_id',
    'price',
    'active',
    'position',
    'required',
    'max',
    'min',
    'with_notes',
    'searcheable',
    'discount'
  ];

  protected $presenter = CharacteristicPresenter::class;

  protected $casts = [
    'options' => 'array',
    'price' => 'integer',
  ];

  public function product()
  {
    return $this->belongsTo(Product::class);
  }

  public function parent()
  {
    return $this->belongsTo(Characteristic::class, 'parent_id');
  }

  public function children()
  {
    return $this->hasMany(Characteristic::class, 'parent_id');
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

  public function getValueWithDiscountAttribute(){
    return $this->price - $this->discount;
  }

}
