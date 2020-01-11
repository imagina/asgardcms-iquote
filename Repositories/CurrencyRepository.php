<?php

namespace Modules\Iquote\Repositories;

use Modules\Core\Repositories\BaseRepository;

interface CurrencyRepository extends BaseRepository
{
    public function getItemsBy($params);

    public function getItem($criteria, $params);
}
