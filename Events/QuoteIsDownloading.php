<?php

namespace Modules\Iquote\Events;


class QuoteIsDownloading
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
