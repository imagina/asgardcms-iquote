<?php

namespace Modules\Iquote\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Modules\Iquote\Events\Handlers\DownloadQuote;
use Modules\Iquote\Events\Handlers\SendEmail;
use Modules\Iquote\Events\QuoteIsDownloading;
use Modules\Iquote\Events\QuoteIsSending;


class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        QuoteIsSending::class=>[
            SendEmail::class,
        ],
        QuoteIsDownloading::class=>[
          DownloadQuote::class,
        ]
    ];

}
