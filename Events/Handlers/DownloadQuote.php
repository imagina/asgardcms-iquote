<?php
namespace Modules\Iquote\Events\Handlers;
use Illuminate\Contracts\Mail\Mailer;
use Modules\Iprofile\Transformers\UserTransformer;
use Modules\Iquote\Emails\Sendmail;
use Modules\Iquote\Events\QuoteIsDownloading;
use Illuminate\Support\Facades\Auth;
use PDF;
class DownloadQuote
{
  private $pdf;
  private $setting;
  public function __construct()
  {
    $this->pdf = app('dompdf.wrapper');
    $this->setting = app('Modules\Setting\Contracts\Setting');
  }
  public function handle(QuoteIsDownloading $event)
  {
    $quote = $event->entity;
    if (isset($quote->user->email) && !empty($quote->user->email)) {
      array_push($emails, $quote->user->email);
    }
    //$user = Auth::user();

    $this->pdf->loadView('iquote::frontend.pdf.quotes',compact('quote'));
    $path = public_path('modules/iquote/pdf/');
    $this->pdf->setPaper('Letter','portrait');
    $fileName = "quote".str_pad($quote->id,5,'0',STR_PAD_LEFT).".pdf";
    $this->pdf->save($path.$fileName);
  }
}
