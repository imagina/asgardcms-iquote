<?php

namespace Modules\Iquote\Http\Controllers\Api;

// Requests & Response
use Modules\Iquote\Http\Requests\CreatePackageProductRequest;
use Modules\Iquote\Http\Requests\UpdatePackageProductRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

// Base Api
use Modules\Ihelpers\Http\Controllers\Api\BaseApiController;

// Transformers
use Modules\Iquote\Transformers\PackageProductTransformer;

// Repositories
use Modules\Iquote\Repositories\PackageProductRepository;

class PackageProductApiController extends BaseApiController
{
  private $packageProduct;

  public function __construct(PackageProductRepository $packageProduct)
  {
    $this->packageProduct = $packageProduct;
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
      $packagesProducts = $this->packageProduct->getItemsBy($params);
      //Response
      $response = ["data" => PackageProductTransformer::collection($packagesProducts)];
      //If request pagination add meta-page
      $params->page ? $response["meta"] = ["page" => $this->pageTransformer($packagesProducts)] : false;
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
      $packageProduct = $this->packageProduct->getItem($criteria, $params);
      //Break if no found item
      if (!$packageProduct) throw new Exception('Item not found', 204);
      //Response
      $response = ["data" => new PackageProductTransformer($packageProduct)];
      //If request pagination add meta-page
      $params->page ? $response["meta"] = ["page" => $this->pageTransformer($packageProduct)] : false;
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
      $this->validateRequestApi(new CreatePackageProductRequest($data));
      //Create item
      $packageProduct = $this->packageProduct->create($data);
      //Response
      $response = ["data" => new PackageProductTransformer($packageProduct)];
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
      $this->validateRequestApi(new UpdatePackageProductRequest($data));
      //Update data
      $packageProduct = $this->packageProduct->updateBy($criteria, $data, $params);
      //Response
      $response = ['data' => $packageProduct];
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
      $this->packageProduct->deleteBy($criteria, $params);
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

}
