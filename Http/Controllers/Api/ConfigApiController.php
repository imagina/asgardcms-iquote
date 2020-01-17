<?php

namespace Modules\Iquote\Http\Controllers\Api;

// Requests & Response
use Illuminate\Http\Request;
use Illuminate\Http\Response;

// Base Api
use Modules\Ihelpers\Http\Controllers\Api\BaseApiController;

class ConfigApiController extends BaseApiController
{

  /**
   * @var
   */
  private $fields;

  /**
   * ConfigApiController constructor.
   */
  public function __construct()
  {
      $this->fields = collect( config( 'asgard.iquote.config.fields' ) );
  }

  /**
   * @param Request $request
   * @return mixed
   */
  public function index ( Request $request )
  {
      try {
          $params = $this->getParamsRequest( $request );
          $response = [
            "data" => $this->getConfigsBy( $params )
          ];
      } catch ( \Exception $e ) {
          $status = $this->getStatusError( $e->getCode() );
          $response = [
            "errors" => $e->getMessage()
          ];
      }
      return response()->json($response, $status ?? 200);
  }

  /**
   * @param $params
   * @return array
   */
  private function getConfigsBy ($params)
  {
    if ( isset( $params->filter->entity ) )
    {
      return $this->fields[$params->filter->entity] ?? [];
    }
    return $this->fields;
  }

}
