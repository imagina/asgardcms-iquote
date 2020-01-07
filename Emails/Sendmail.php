<?php

namespace Modules\Iquote\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Modules\Iquote\Transformers\QuoteTransformer;

class Sendmail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;


    public $quote;
    public $subject;
    public $view;

    /**
     * Create a new message instance.
     *
     * @param QuoteTransformer $quote
     * @param $subject
     * @param $view
     */
    public function __construct($quote, $subject, $view)
    {
        $this->quote=$quote;
        $this->subject=$subject;
        $this->view=$view;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view($this->view)->subject($this->subject);
    }
}
