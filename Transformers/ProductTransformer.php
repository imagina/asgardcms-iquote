<?php


namespace Modules\Iquote\Transformers;

use Illuminate\Http\Resources\Json\Resource;
use Modules\Icurrency\Facades\Currency;

class ProductTransformer extends Resource
{
  public function toArray($request)
  {
    $data = [
      'id' => $this->when($this->id, $this->id),
      'active' => $this->active ? true : false,
      'price' => Currency::convert($this->price),
      'discount' => Currency::convert($this->discount),
      'valueWithDiscount' => Currency::convert($this->valueWithDiscount),
      'name' => $this->when($this->name, $this->name),
      'isDisabled' => false,
      'checked' => false,
      'description' => $this->when($this->description, $this->description),
      'createdAt' => $this->when($this->created_at, $this->created_at),
      'mainImage' => $this->main_image,
      'includeInQuotation' => $this->include_in_quotation ? true : false,
      'characteristics' => CharacteristicTransformer::collection($this->whenLoaded('characteristics')),
      'packages' => PackageTransformer::collection($this->whenLoaded('packages')),
    ];

    $filter = json_decode($request->filter);
    // Return data with available translations
    if (isset($filter->allTranslations) && $filter->allTranslations) {
      // Get langs avaliables
      $languages = \LaravelLocalization::getSupportedLocales();
      foreach ($languages as $lang => $value) {
        $data[$lang]['name'] = $this->hasTranslation($lang) ? $this->translate("$lang")['name'] : '';
        $data[$lang]['description'] = $this->hasTranslation($lang) ? $this->translate("$lang")['description'] ?? '' : '';
      }
    }

    return $data;
  }

}
