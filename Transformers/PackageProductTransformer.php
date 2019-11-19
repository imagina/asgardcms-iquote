<?php


namespace Modules\Iquote\Transformers;

use Illuminate\Http\Resources\Json\Resource;

class PackageProductTransformer extends Resource
{

  public function toArray($request)
  {
    $data = [
      'id' => $this->when($this->id, $this->id),
      'productId' => $this->when($this->product_id, $this->product_id),
      'packageId' => $this->when($this->package_id, $this->package_id),
      'product' => new ProductTransformer($this->whenLoaded('product')),
      'package' => new PackageTransformer($this->whenLoaded('package')),
    ];
    return $data;
  }

}
