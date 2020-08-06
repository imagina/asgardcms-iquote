<?php

namespace Modules\Iquote\Transformers;

use Illuminate\Http\Resources\Json\Resource;
use Modules\Icurrency\Facades\Currency;


class CharacteristicTransformer extends Resource
{
  public function toArray($request)
  {
    $data = [
      'id' => $this->when($this->id, $this->id),
      'productId' => $this->when( $this->product_id, $this->product_id ),
      'type' => $this->when( $this->type, intval($this->type)),
      'typeName' => $this->when($this->type, $this->present()->type),
      'parentId' => $this->parent_id ? $this->parent_id : null,
      'price' => Currency::convert($this->price),
      'discount' => Currency::convert($this->discount),
      'valueWithDiscount' => Currency::convert($this->valueWithDiscount),
      'active' => $this->active ? true : false,
      'name' => $this->when( $this->name, $this->name ),
      'description' => $this->when( $this->description, $this->description ),
      'position' => $this->position,
      'required' => $this->required ? true : false,
      'createdAt' => $this->when($this->created_at, $this->created_at),
      'options' => $this->when( $this->options, $this->options ),
      'max' => $this->max ? intval($this->max) : 0,
      'min' => $this->min ? intval($this->min) : 0,
      'model' => $this->getModel($this->type),
      'checked' => true,
      'show' => false,
      'searcheable' => $this->searcheable ? true : false,
      'withNotes' =>  $this->with_notes ? true : false,
      'notes' =>  '',
      'childrengenerated' =>  $this->when($this->type == 4, ''),
      'mainImage' => $this->main_image,
      'product' => new ProductTransformer ($this->whenLoaded('product')),
      'parent' => new CharacteristicTransformer ($this->whenLoaded('parent')),
      'childrens' => CharacteristicTransformer::collection($this->whenLoaded('children')),
    ];

    $filter = json_decode($request->filter);
    // Return data with available translations
    if (isset($filter->allTranslations) && $filter->allTranslations) {
      // Get langs avaliables
      $languages = \LaravelLocalization::getSupportedLocales();
      foreach ($languages as $lang => $value) {
        $data[$lang]['name'] = $this->hasTranslation($lang) ? $this->translate("$lang")['name'] : '';
        $data[$lang]['description'] = $this->hasTranslation($lang) ? $this->translate("$lang")['description'] ?? '' : '';
        $data[$lang]['options'] = $this->hasTranslation($lang) ? $this->translate("$lang")['options'] : '';
      }
    }

    if (isset($filter->allCurrencies) && $filter->allCurrencies) {
      $currencies = Currency::getSupportedCurrencies();
      foreach ($currencies as $item => $val) {
        $data[$val->code]['price'] = Currency::convertFromTo($this->price, $val->code);
      }
    }

    return $data;
  }

  private function getModel ($type) {
    if ($type == 2) {
      return false;
    }
    if ($type == 4 || $type == 3) {
      return 0;
    }
    return '';
  }
}
