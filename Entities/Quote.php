<?php

namespace Modules\Iquote\Entities;

use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;
use Modules\Iquote\Presenters\QuotePresenter;

class Quote extends Model
{
  use PresentableTrait;
  protected $table = 'iquote__quotes';

  protected $fillable = [
    'first_name',
    'last_name',
    'email',
    'phone',
    'notes',
    'value',
    'user_id',
    'customer_id',
  ];

  protected $presenter = QuotePresenter::class;

  protected $casts = [
    'value' => 'array',
  ];

  public function user()
  {
    $driver = config('asgard.user.config.driver');
    return $this->belongsTo("Modules\\User\\Entities\\{$driver}\\User",'user_id');
  }

  public function customer()
  {
    $driver = config('asgard.user.config.driver');
    return $this->belongsTo("Modules\\User\\Entities\\{$driver}\\User",'customer_id');
  }

}
