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
use Modules\Ihelpers\Http\Controllers\Api\BaseApiController;

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


    public function downloadQuote(Quote $quote, Request $request)
    {
      try {
        set_time_limit(300); // Extends to 5 minutes.
        $emails = [];
        if (isset($quote->user->email) && !empty($quote->user->email)) {
          array_push($emails, $quote->user->email);
        }
        $this->pdf->loadView('iquote::frontend.pdf.quotes',compact('quote'));
        $this->pdf->setPaper('Letter','portrait');
        return $this->pdf->stream();
      } catch (\Exception $e) {
          \Log::error($e->getMessage().' '.$e->getFile().' '.$e->getLine());
        return redirect()->to('/')
          ->withErrors(["error"=>"Error: ".$e->getMessage()." - Line ".$e->getLine()]);
      }
    }

    public function showQuoteHTML(Quote $quote)
    {
      try {
        set_time_limit(300); // Extends to 5 minutes.
        $emails = [];
        if (isset($quote->user->email) && !empty($quote->user->email)) {
          array_push($emails, $quote->user->email);
        }
        $quote->options = json_decode(json_encode($quote->options));
        return view('iquote::frontend.pdf.quotes',compact('quote'));
      } catch (\Exception $e) {
        return redirect()->to('/')
          ->withErrors(["error"=>"Error: ".$e->getMessage()." - Line ".$e->getLine()]);
      }
    }
}
