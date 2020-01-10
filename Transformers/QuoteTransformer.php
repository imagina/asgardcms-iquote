<?php

namespace Modules\Iquote\Transformers;
use Illuminate\Http\Resources\Json\Resource;
use Modules\User\Transformers\UserProfileTransformer;
use Modules\Iprofile\Transformers\UserTransformer;
class QuoteTransformer extends Resource
{
  public function toArray($request)
  {
    $data = [
      'id' => $this->when($this->id, $this->id),
      'firstName' => $this->when($this->first_name, $this->first_name),
      'lastName' => $this->when($this->last_name, $this->last_name),
      'email' => $this->when($this->email, $this->email),
      'phone' => $this->when($this->phone, $this->phone),
      'notes' => $this->when($this->notes, $this->notes),
      'value' => $this->when($this->value, $this->value),
      'treePdf' => $this->when($this->value,$this->present()->treePdf()),
      'total' => $this->when($this->value,$this->present()->total()),
      'options' => $this->when($this->options,$this->options),
      'userId' => $this->when($this->user_id, $this->user_id),
      'customerId' => $this->when($this->customer_id, $this->customer_id),
      'user' => new UserTransformer($this->whenLoaded('user')),
      'customer' => new UserTransformer($this->whenLoaded('customer')),
    ];
    return $data;
  }
}
