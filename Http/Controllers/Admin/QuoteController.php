<?php

namespace Modules\Iquote\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Iquote\Entities\Quote;
use Modules\Iquote\Events\QuoteIsDownloading;
use Modules\Iquote\Http\Requests\CreateQuoteRequest;
use Modules\Iquote\Http\Requests\UpdateQuoteRequest;
use Modules\Iquote\Repositories\QuoteRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;
use Modules\Iquote\Transformers\QuoteTransformer;

class QuoteController extends AdminBaseController
{
    /**
     * @var QuoteRepository
     */
    private $quote;

    public function __construct(QuoteRepository $quote)
    {
        parent::__construct();

        $this->quote = $quote;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //$quotes = $this->quote->all();

        return view('iquote::admin.quotes.index', compact(''));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('iquote::admin.quotes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateQuoteRequest $request
     * @return Response
     */
    public function store(CreateQuoteRequest $request)
    {
        $this->quote->create($request->all());

        return redirect()->route('admin.iquote.quote.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('iquote::quotes.title.quotes')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Quote $quote
     * @return Response
     */
    public function edit(Quote $quote)
    {
        return view('iquote::admin.quotes.edit', compact('quote'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Quote $quote
     * @param  UpdateQuoteRequest $request
     * @return Response
     */
    public function update(Quote $quote, UpdateQuoteRequest $request)
    {
        $this->quote->update($quote, $request->all());

        return redirect()->route('admin.iquote.quote.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('iquote::quotes.title.quotes')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Quote $quote
     * @return Response
     */
    public function destroy(Quote $quote)
    {
        $this->quote->destroy($quote);

        return redirect()->route('admin.iquote.quote.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('iquote::quotes.title.quotes')]));
    }


  /**
   * download the specified quote to pdf.
   * @param Quote $quote
   * @param  Request $request
   * @return Response
   */
  public function download(Quote $quote, Request $request)
  {
    \DB::beginTransaction();
    try {
      $params = $this->getParamsRequest($request);
      $data = $request->input('attributes');
      //Validate Request
      //$this->validateRequestApi(new UpdateQuoteRequest($data));
      //Update data
      $model = $quote;
      $quote = new QuoteTransformer($model);
      event(new QuoteIsDownloading(json_decode(json_encode($quote))));
      $pdfRoute = "modules/iquote/pdf/quote".str_pad($quote->id,5,"0",STR_PAD_LEFT).".pdf";
      //Response
      \DB::commit(); //Commit to Data Base
    } catch (\Exception $e) {
      \DB::rollback();//Rollback to Data Base
      $status = $this->getStatusError($e->getCode());
      $response = ["errors" => $e->getMessage().' '.$e->getFile().' '.$e->getLine()];
      return redirect()->route('admin.iquote.quote.index')
        ->withErrors(["Error: ".$e->getMessage()]);
    }
  }
}
