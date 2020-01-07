<?php

namespace Modules\Iquote\Http\Controllers\Api;

// Base Api
use Modules\Ihelpers\Http\Controllers\Api\BaseApiController;

// Entities
use Modules\Iquote\Entities\Type;

class TypeApiController extends BaseApiController
{

  private $type;

  public function __construct(Type $type)
  {
    $this->type = $type;
  }

  /**
   * Display a listing of the resource.
   * @return Response
   */
  public function index()
  {
    try {
      $types = $this->type->all();
      $response=[
        'data' => $types
      ];
    }  catch (\Exception $e) {
      $status = 500;
      $response = [
        'errors' => $e->getMessage()
      ];
    }
    return response()->json($response, $status ?? 200);
  }

}
