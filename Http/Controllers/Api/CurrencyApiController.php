<?php

namespace Modules\Iquote\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

// Base Api
use Modules\Ihelpers\Http\Controllers\Api\BaseApiController;

// Entities
use Modules\Iquote\Entities\Currency;

use Modules\Iquote\Transformers\CurrencyTransformer;

use Modules\Iquote\Repositories\CurrencyRepository;

class CurrencyApiController extends BaseApiController
{

  private $currency;

  public function __construct(CurrencyRepository $currency)
  {
    $this->currency = $currency;
  }

  /**
   * GET ITEMS
   *
   * @return mixed
   */
  public function index(Request $request)
  {
    try {
      //Get Parameters from URL.
      $params = $this->getParamsRequest($request);
      //Request to Repository
      $currencies = $this->currency->getItemsBy($params);
      //Response
      $response = ["data" => CurrencyTransformer::collection($currencies)];
      //If request pagination add meta-page
      $params->page ? $response["meta"] = ["page" => $this->pageTransformer($currencies)] : false;
    } catch (\Exception $e) {
      $status = $this->getStatusError($e->getCode());
      $response = ["errors" => $e->getMessage()];
    }
    //Return response
    return response()->json($response ?? ["data" => "Request successful"], $status ?? 200);
  }


}
