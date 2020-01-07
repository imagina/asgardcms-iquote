<?php


namespace Modules\Iquote\Transformers;

use Illuminate\Http\Resources\Json\Resource;
use Modules\User\Transformers\UserProfileTransformer;

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
      'tree' => $this->when($this->value,$this->present()->tree()),
      'userId' => $this->when($this->user_id, $this->user_id),
      'customerId' => $this->when($this->customer_id, $this->customer_id),
      'user' => new UserProfileTransformer($this->whenLoaded('user')),
      'customer' => new UserProfileTransformer($this->whenLoaded('customer')),
    ];
    return $data;
  }

}
