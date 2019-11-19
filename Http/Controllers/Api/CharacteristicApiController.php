<?php

namespace Modules\Iquote\Http\Controllers\Api;

// Requests & Response
use Modules\Iquote\Http\Requests\CreateCharacteristicRequest;
use Modules\Iquote\Http\Requests\UpdateCharacteristicRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

// Base Api
use Modules\Ihelpers\Http\Controllers\Api\BaseApiController;

// Transformers
use Modules\Iquote\Transformers\CharacteristicTransformer;

// Repositories
use Modules\Iquote\Repositories\CharacteristicRepository;

// Services
use Modules\Iquote\Services\CharacteristicOrdener;

class CharacteristicApiController extends BaseApiController
{

  private $characteristic;
  private $characteristicOrdener;

  public function __construct(CharacteristicRepository $characteristic, CharacteristicOrdener $characteristicOrdener)
  {
    $this->characteristicOrdener = $characteristicOrdener;
    $this->characteristic = $characteristic;
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
      $characteristics = $this->characteristic->getItemsBy($params);
      //Response
      $response = ["data" => CharacteristicTransformer::collection($characteristics)];
      //If request pagination add meta-page
      $params->page ? $response["meta"] = ["page" => $this->pageTransformer($characteristics)] : false;
    } catch (\Exception $e) {
      $status = $this->getStatusError($e->getCode());
      $response = ["errors" => $e->getMessage()];
    }
    //Return response
    return response()->json($response ?? ["data" => "Request successful"], $status ?? 200);
  }

  /**
   * GET A ITEM
   *
   * @param $criteria
   * @return mixed
   */
  public function show($criteria, Request $request)
  {
    try {
      //Get Parameters from URL.
      $params = $this->getParamsRequest($request);
      //Request to Repository
      $characteristic = $this->characteristic->getItem($criteria, $params);
      //Break if no found item
      if (!$characteristic) throw new Exception('Item not found', 204);
      //Response
      $response = ["data" => new CharacteristicTransformer($characteristic)];
      //If request pagination add meta-page
      $params->page ? $response["meta"] = ["page" => $this->pageTransformer($characteristic)] : false;
    } catch (\Exception $e) {
      $status = $this->getStatusError($e->getCode());
      $response = ["errors" => $e->getMessage()];
    }
    //Return response
    return response()->json($response ?? ["data" => "Request successful"], $status ?? 200);
  }

  /**
   * CREATE A ITEM
   *
   * @param Request $request
   * @return mixed
   */
  public function create(Request $request)
  {
    \DB::beginTransaction();
    try {
      $data = $request->input('attributes') ?? [];//Get data
      //Validate Request
      $this->validateRequestApi(new CreateCharacteristicRequest($data));
      //Create item
      $characteristic = $this->characteristic->create($data);
      //Response
      $response = ["data" => new CharacteristicTransformer($characteristic)];
      \DB::commit(); //Commit to Data Base
    } catch (\Exception $e) {
      \DB::rollback();//Rollback to Data Base
      $status = $this->getStatusError($e->getCode());
      $response = ["errors" => $e->getMessage()];
    }
    //Return response
    return response()->json($response ?? ["data" => "Request successful"], $status ?? 200);
  }

  /**
   * Update the specified resource in storage.
   * @param  Request $request
   * @return Response
   */
  public function update($criteria, Request $request)
  {
    \DB::beginTransaction();
    try {
      $params = $this->getParamsRequest($request);
      $data = $request->input('attributes');
      //Validate Request
      $this->validateRequestApi(new UpdateCharacteristicRequest($data));
      //Update data
      $characteristic = $this->characteristic->updateBy($criteria, $data, $params);
      //Response
      $response = ['data' => $characteristic];
      \DB::commit(); //Commit to Data Base
    } catch (\Exception $e) {
      \DB::rollback();//Rollback to Data Base
      $status = $this->getStatusError($e->getCode());
      $response = ["errors" => $e->getMessage()];
    }
    return response()->json($response, $status ?? 200);
  }


  /**
   * Remove the specified resource from storage.
   * @return Response
   */
  public function delete($criteria, Request $request)
  {
    \DB::beginTransaction();
    try {
      //Get params
      $params = $this->getParamsRequest($request);
      //Delete data
      $this->characteristic->deleteBy($criteria, $params);
      //Response
      $response = ['data' => ''];
      \DB::commit(); //Commit to Data Base
    } catch (\Exception $e) {
      \DB::rollback();//Rollback to Data Base
      $status = $this->getStatusError($e->getCode());
      $response = ["errors" => $e->getMessage()];
    }
    return response()->json($response, $status ?? 200);
  }

  /**
   * Update Order.
   * @return Response
   */
  public function updateOrder(Request $request)
  {
    try{
      $data = $request->input('attributes');
      $response = [
        'data' => $this->characteristicOrdener->handle(json_encode($data['characteristics']))
      ];
    }  catch (\Exception $e) {
      $status = $this->getStatusError($e->getCode());
      $response = ["errors" => $e->getMessage()];
    }
    return response()->json($response, $status ?? 200);
  }

}
