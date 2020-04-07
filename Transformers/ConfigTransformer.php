<?php

namespace Modules\Iquote\Transformers;

use Illuminate\Http\Resources\Json\Resource;

class ConfigTransformer extends Resource
{
  public function toArray($request)
  {
    $data = [
        'label' => $this->when( $this->label, $this->label),
        'value' => $this->when( $this->value, $this->value),
        'type' => $this->when( $this->type, $this->type),
        'rules' => $this->when( $this->rules, $this->rules),
        'apiRoute' => $this->when( $this->apiRoute, $this->apiRoute),
        'select' => $this->when( $this->select, $this->select),
    ];

    return $data;
  }

}
