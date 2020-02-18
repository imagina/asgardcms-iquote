<?php

namespace Modules\Iquote\Http\Controllers;

use Illuminate\Http\Request;
use Log;
use Mockery\CountValidator\Exception;
use Modules\Core\Http\Controllers\BasePublicController;
use Modules\Iquote\Entities\Quote;
use Modules\Iquote\Events\QuoteIsDownloading;
use Modules\Iquote\Repositories\QuoteRepository;
use Modules\Iquote\Transformers\QuoteTransformer;
use Route;
use PDF;

class PublicController extends BasePublicController
{
    private $quote;
    private $pdf;

    public function __construct(QuoteRepository $quote)
    {
        parent::__construct();
        $this->pdf = app('dompdf.wrapper');
        $this->quote = $quote;
    }


    public function downloadQuote(Quote $quote)
    {
      try {
        set_time_limit(300); // Extends to 5 minutes.
        $model = $quote;
        $quote = json_decode(json_encode(new QuoteTransformer($model)));
        \Log::info(print_r($quote,true));
        if (isset($quote->user->email) && !empty($quote->user->email)) {
          array_push($emails, $quote->user->email);
        }
        //$user = Auth::user();

        $this->pdf->loadView('iquote::frontend.pdf.quotes',compact('quote'));
        $this->pdf->setPaper('Letter','portrait');
        return $this->pdf->stream();
      } catch (\Exception $e) {
        return redirect()->to('/')
          ->withErrors(["error"=>"Error: ".$e->getMessage()." - Line ".$e->getLine()]);
      }
    }
}
