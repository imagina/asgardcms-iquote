<?php

namespace Modules\Iquote\Entities;

class Type
{

  const SELECT = 1;
  const CHECKBOX = 2;
  const VALUE = 3;
  const NUMBER = 4;
  const OPTION = 5;

  /**
   * @var array
   */
  private $types = [];

  public function __construct()
  {
    $this->types = [
      self::SELECT => trans('iquote::common.status.select'),
      self::CHECKBOX => trans('iquote::common.status.checkbox'),
      self::VALUE => trans('iquote::common.status.value'),
      self::NUMBER => trans('iquote::common.status.number'),
      self::OPTION => trans('iquote::common.status.option'),
    ];
  }

  /**
   * Get the available statuses
   * @return array
   */
  public function lists()
  {
    return  $this->types;
  }

  public function all()
  {
    return [
      [
        'value' => self::SELECT,
        'label' => trans('iquote::common.status.select')
      ],
      [
        'value' => self::CHECKBOX,
        'label' => trans('iquote::common.status.checkbox'),
      ],
      [
        'value' => self::VALUE,
        'label' => trans('iquote::common.status.value'),
      ],
      [
        'value' => self::NUMBER,
        'label' => trans('iquote::common.status.number'),
      ],
      [
        'value' => self::OPTION,
        'label' => trans('iquote::common.status.option'),
      ],
    ];
  }

  /**
   * Get the post status
   * @param int $statusId
   * @return string
   */
  public function get($id)
  {
    if (isset($this->types[$id])) {
      return $this->types[$id];
    }
    return $this->types[self::SELECT];
  }

}
