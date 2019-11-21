<?php

namespace Modules\Iquote\Transformers;

use Illuminate\Http\Resources\Json\Resource;

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
      'price' => $this->price,
      'active' => $this->active ? true : false,
      'name' => $this->when( $this->name, $this->name ),
      'description' => $this->when( $this->description, $this->description ),
      'position' => $this->position,
      'required' => $this->required ? true : false,
      'createdAt' => $this->when($this->created_at, $this->created_at),
      'options' => $this->when( $this->options, $this->options ),
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

    return $data;
  }
}
