<?php

namespace Modules\Iquote\Events;


class QuoteIsSending
{
    public $entity;

    /**
     * Create a new event instance.
     *
     * @param $entity
     * @param array $data
     */
    public function __construct($entity)
    {
      $this->entity=$entity;
    }

    public function getEntity()
    {
        return $this->entity;
    }

}
