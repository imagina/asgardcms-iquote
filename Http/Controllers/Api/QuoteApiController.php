<?php

namespace Modules\Iquote\Http\Controllers\Api;

// Requests & Response
use Modules\Iquote\Events\QuoteIsDownloading;
use Modules\Iquote\Events\QuoteIsSending;
use Modules\Iquote\Http\Requests\CreateQuoteRequest;
use Modules\Iquote\Http\Requests\UpdateQuoteRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

// Base Api
use Modules\Ihelpers\Http\Controllers\Api\BaseApiController;

// Transformers
use Modules\Iquote\Transformers\QuoteTransformer;

// Repositories
use Modules\Iquote\Repositories\QuoteRepository;

class QuoteApiController extends BaseApiController
{
  private $quote;

  public function __construct(QuoteRepository $quote)
  {
    $this->quote = $quote;
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
      $quotes = $this->quote->getItemsBy($params);
      //Response
      $response = ["data" => QuoteTransformer::collection($quotes)];
      //If request pagination add meta-page
      $params->page ? $response["meta"] = ["page" => $this->pageTransformer($quotes)] : false;
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
      $quote = $this->quote->getItem($criteria, $params);
      //Break if no found item
      if (!$quote) throw new \Exception('Item not found', 204);
      //Response
      $response = ["data" => new QuoteTransformer($quote)];
      //If request pagination add meta-page
      $params->page ? $response["meta"] = ["page" => $this->pageTransformer($quote)] : false;
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
      $this->validateRequestApi(new CreateQuoteRequest($data));
      //Create item
      $quote = $this->quote->create($data);
      //Response
      $response = ["data" => new QuoteTransformer($quote)];
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
      $this->validateRequestApi(new UpdateQuoteRequest($data));
      //Update data
      $quote = $this->quote->updateBy($criteria, $data, $params);
      //Response
      $response = ['data' => $quote];
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
      $this->quote->deleteBy($criteria, $params);
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
   * Send the specified quote to mail.
   * @param $criteria
   * @param  Request $request
   * @return Response
   */
  public function sendQuote($criteria, Request $request)
  {
    \DB::beginTransaction();
    try {
      $params = $this->getParamsRequest($request);
      $data = $request->input('attributes');
      //Validate Request
      //$this->validateRequestApi(new UpdateQuoteRequest($data));
      //Update data
      $model = $this->quote->getItem($criteria, $params);
      $quote = new QuoteTransformer($model);

      event(new QuoteIsSending(json_decode(json_encode($quote))));

      //Response
      $response = ['data' => $quote];
      \DB::commit(); //Commit to Data Base
    } catch (\Exception $e) {
      \DB::rollback();//Rollback to Data Base
      $status = $this->getStatusError($e->getCode());
      $response = ["errors" => $e->getMessage().' '.$e->getFile().' '.$e->getLine()];
    }
    return response()->json($response, $status ?? 200);
  }

  /**
   * download the specified quote to pdf.
   * @param $criteria
   * @param  Request $request
   * @return Response
   */
  public function downloadQuote($criteria, Request $request)
  {
    \DB::beginTransaction();
    try {
      $params = $this->getParamsRequest($request);
      $data = $request->input('attributes');
      //Validate Request
      //$this->validateRequestApi(new UpdateQuoteRequest($data));
      //Update data
      $model = $this->quote->getItem($criteria, $params);
      $quote = new QuoteTransformer($model);
      event(new QuoteIsDownloading(json_decode(json_encode($quote))));
      $pdfRoute = "modules/iquote/pdf/quote".str_pad($quote->id,5,"0",STR_PAD_LEFT).".pdf";
      //Response
      $response = ['data' => ['pdfUrl'=> url($pdfRoute)]];
      \DB::commit(); //Commit to Data Base
    } catch (\Exception $e) {
      \DB::rollback();//Rollback to Data Base
      $status = $this->getStatusError($e->getCode());
      $response = ["errors" => $e->getMessage().' '.$e->getFile().' '.$e->getLine()];
    }
    return response()->json($response, $status ?? 200);
  }

}
