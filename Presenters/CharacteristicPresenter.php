<?php

namespace Modules\Iquote\Presenters;

use Laracasts\Presenter\Presenter;
use Modules\Iquote\Entities\Type;

class CharacteristicPresenter extends Presenter
{
    /**
     * @var \Modules\Iquote\Entities\Type;
     */
    protected $type;
    /**
     * @var \Modules\Iquote\Repositories\CharacteristicRepository
     */
    private $characteristic;

    public function __construct($entity)
    {
        parent::__construct($entity);
        $this->characteristic = app('Modules\Iquote\Repositories\CharacteristicRepository');
        $this->type = app('Modules\Iquote\Entities\Type');
    }

    /**
     * Get the post status
     * @return string
     */
    public function type()
    {
        return $this->type->get($this->entity->type);
    }

}
