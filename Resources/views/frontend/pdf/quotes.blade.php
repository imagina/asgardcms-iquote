<!doctype html>
<html lang="{{ locale() }}">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta charset="utf-8" />
        <title>{{ setting('core::site-name') }} - {{ trans('iquote::iquotes.title.iquotes') }} #{{ str_pad($quote->id,5,'0',STR_PAD_LEFT) }}</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css" type="text/css" />
        <style type="text/css">
            @if(config()->has('asgard.iquote.config.fontName'))
                @font-face {
                font-family: "{{ config()->get('asgard.iquote.config.fontName') }}";
                font-weight: normal;
                font-style : normal;
                src : url("{{ Module::asset('iquote:fonts/'.config()->get('asgard.iquote.config.fontName').'-Regular.ttf') }}") format("truetype");
                }

                @font-face {
                    font-family: "{{ config()->get('asgard.iquote.config.fontName') }}";
                    font-weight: bold;
                    font-style : normal;
                    src : url("{{ Module::asset('iquote:fonts/'.config()->get('asgard.iquote.config.fontName').'-Bold.ttf') }}") format("truetype");
                }

                @font-face {
                    font-family: "{{ config()->get('asgard.iquote.config.fontName') }}";
                    font-weight: normal;
                    font-style : italic;
                    src : url("{{ Module::asset('iquote:fonts/'.config()->get('asgard.iquote.config.fontName').'-Italic.ttf') }}") format("truetype");
                }

                @font-face {
                    font-family: "{{ config()->get('asgard.iquote.config.fontName') }}";
                    font-weight: bold;
                    font-style : italic;
                    src : url("{{ Module::asset('iquote:fonts/'.config()->get('asgard.iquote.config.fontName').'-BoldItalic.ttf') }}") format("truetype");
                }
            @endif

            @font-face {
                font-family: "FontAwesomeRegular";
                font-weight: normal;
                font-style : normal;
                src : url("https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/webfonts/fa-regular-400.ttf") format("truetype");
            }
            @font-face {
                font-family: "FontAwesomeBrands";
                font-weight: normal;
                font-style : normal;
                src : url("https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/webfonts/fa-brands-400.ttf") format("truetype");
            }
            @font-face {
                font-family: "FontAwesomeSolid";
                font-weight: bold;
                font-style : normal;
                src : url("https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/webfonts/fa-solid-900.ttf") format("truetype");
            }

            .bg-1{
                position: absolute;
                top: 0;
                left: 0;
                margin: 0 -25px;
                width: 100%;
                height: 30mm;
                z-index: -1;
            }
            .bg-1 img{
                width: 100%;
                height: auto;
            }

            .bg-1 .head-text{
                position: absolute;
                text-align: right;
                padding-right: 25px;
                top: 20mm;
                right: 0;
                width: 100%;
            }

            /*.bg-1{
                width: 60mm!important;
                left: -30px;
                background-image: url('{{ Module::asset('iquote:img/pdf-bg1.png') }}');
            }

            .bg-2{
                right: -40px;
                background-image: url('{{ Module::asset('iquote:img/pdf-bg2.png') }}');
            }*/

            .fas,.fab,.far{
                padding-right: 5px;
            }

            .fas{
                font-weight: bold !important;
                font-family: FontAwesomeSolid !important;
            }

            .fas:before{
                font-weight: bold !important;
                font-family: FontAwesomeSolid !important;
            }

            .fab{
                font-weight: normal !important;
                font-family: FontAwesomeBrands !important;
            }
            .fab:before{
                font-weight: normal !important;
                font-family: FontAwesomeBrands !important;
            }
            .far{
                font-weight: normal !important;
                font-family: FontAwesomeRegular !important;
            }
            .far:before{
                font-weight: normal !important;
                font-family: FontAwesomeRegular !important;
            }

            .t1 .fas{
                font-size: 5px;
            }

            .border-top-radius{
                border-top-left-radius: 7px;
                border-top-right-radius: 7px;
            }

            .border-bottom-radius{
                border-bottom-left-radius: 7px;
                border-bottom-right-radius: 7px;
            }

            table.t3{
                border-collapse: separate;
                border-spacing: 0;
                overflow: hidden;
                /*border-radius: 7px;
                border: 1px solid #E5E5E5;*/
                padding-bottom: 25px;
            }

            * {
                @if(config()->has('asgard.iquote.config.fontName'))
                    font-family: '{{ config()->get('asgard.iquote.config.fontName') }}', sans-serif;
                @else
                    font-family: Helvetica, sans-serif;
                @endif
                box-sizing: border-box;
            }

            .mj-column-per-66 {
                width:66.66666666666666%!important;
                display: inline-block!important;
                vertical-align: top;
            }
            .mj-column-per-33 {
                width: 33.33333333333333% !important;
                display: inline-block !important;
                vertical-align: top;
            }
            .mj-column-per-100 {
                width:100%!important;
                vertical-align: top;
            }
            .mj-column-per-50 {
                width:50%!important;
                display: inline-block!important;
                vertical-align: top;
            }

            .mj-column-per-20 {
                width: 17.5%!important;
                display: inline-block!important;
                vertical-align: top;
                padding: 0 8px;
            }

            .head-title {
                background-color: {{ setting('isite::brandPrimary') }}!important;
                color: #fff;
                padding: 8px;
                font-size: 18px;
                z-index: 1;
                font-weight: bold;
                text-align: center;
            }

            body {
                margin: 0;
                padding: 0;
                -webkit-text-size-adjust: 100%;
                -ms-text-size-adjust: 100%;
            }
            img {
                border: 0;
                height: auto;
                line-height: 100%;
                outline: none;
                text-decoration: none;
                -ms-interpolation-mode: bicubic;
            }
            p {
                display: block;
                margin-bottom: 2px;
            }

            @page {
                margin: 120px 25px 90px;
                size: 215.9mm 279.4mm portrait;
            }

            header {
                position: fixed;
                top: -120px;
                left: 0px;
                right: 0px;
                height: 50px;

                /** Extra personal styles **/
                text-align: center;
                line-height: 35px;
            }

            .footer {
                position: fixed;
                bottom: -10px;
                left: 0px;
                right: 0px;
                height: 110px;
                font-size: 14px;
                margin: 0 -25px -100px;
                line-height: 1.2;
                padding: 15px;
                /** Extra personal styles **/
                /*background-color: {{ setting('isite::brandPrimary') }};*/
                color: {{ setting('isite::brandPrimary') }};
            }

            .pagenum:before {
                content: counter(page);
                font-weight: bold;
                padding: 0 5px;
            }

            table, table tr, table tr td{
                background-color: transparent;
            }

            h1{
                margin: 5px 0;
            }

            .text-primary{
                color: {{ setting('isite::brandPrimary') }};
            }

            .text-secondary{
                color: {{ setting('isite::brandSecondary') }};
            }

            .text-bold{
                font-weight: bold;
            }

            tr.t1{
                background-color: #f0f2f4;
            }

            tr.t1 td {
                border: 1px solid #E5E5E5;
                padding: 5px;
            }

            tr.t1 td:not(:first-child) {
                background-color: #fff;
            }

            .table-bg {
                background-color: #f0f2f4;
                padding: 10px 5px;
            }

            .page-break{ page-break-inside:auto;}

        </style>
    </head>
    <body>
        @php
          /*$user = Auth::user();
          $currentUser = json_decode(json_encode(new Modules\Iprofile\Transformers\UserTransformer(Auth::user())));*/
        @endphp
        <header>
            <div class="bg-1">
                <img src="{{ setting('iquote::logo-header') }}" />
                <div class="text-primary head-text">
                    <strong>
                        <span style="font-size:10px;">{{ setting('core::site-name') }} - {{ trans('iquote::iquotes.title.iquotes') }} #{{ str_pad($quote->id,5,'0',STR_PAD_LEFT) }}</span>
                    </strong>
                </div>
            </div>
            <div style="width:100%" class="footer">
                @php
                    $imgs = ['logo-footer1','logo-footer2'];
                    $i=0;
                @endphp
                @foreach($imgs as $img)
                    @if(setting('iquote::'.$img))
                        <div class="mj-column-per-20">
                            <img src="{{ setting('iquote::'.$img) }}" width="100%" height="auto" />
                        </div>
                        @php
                          $i++;
                        @endphp
                    @endif
                @endforeach
                @for($j=$i;$j<2;$j++)
                    <div class="mj-column-per-20">
                        &nbsp;
                    </div>
                @endfor
                {{--<div class="mj-column-per-20">
                    <img src="https:{{ Module::asset('iquote:img/img-footer-2.png') }}" width="100%" height="auto" />
                </div>--}}
                <div class="mj-column-per-20">
                    <div style="word-wrap: break-word;margin: 20px -15px">
                        <div><a href="{{ url('') }}" style="text-decoration: none" class="text-primary">{{ url('') }}</a></div>
                        {{--<div><a href="{{ url('') }}" style="text-decoration: none" class="text-primary">https://migrate-au.com</a></div>--}}
                        <div class="pagenum"></div>
                    </div>
                </div>
                @php
                    $imgs = ['logo-footer3','logo-footer4'];
                    $i=0;
                @endphp
                @foreach($imgs as $img)
                    @if(setting('iquote::'.$img))
                        @php
                            $i++;
                        @endphp
                    @endif
                @endforeach
                @for($j=$i;$j<2;$j++)
                    <div class="mj-column-per-20">
                        &nbsp;
                    </div>
                @endfor
                @foreach($imgs as $img)
                    @if(setting('iquote::'.$img))
                        <div class="mj-column-per-20">
                            <img src="{{ setting('iquote::'.$img) }}" width="100%" height="auto" />
                        </div>
                    @endif
                @endforeach
                {{--<div class="mj-column-per-20">
                    <img src="https:{{ Module::asset('iquote:img/img-footer-3.png') }}" width="100%" height="auto" />
                </div>
                <div class="mj-column-per-20">
                    <img src="https:{{ Module::asset('iquote:img/img-footer-4.png') }}" width="100%" height="auto" />
                </div>}}--
                {{--<div style="padding: 10px 20px 5px">

                   @php
                    $addresses = array_column(json_decode(setting('isite::addresses'),true),'value');
                    $phones = array_column(json_decode(setting('isite::phones'),true),'value');
                    $emails = array_column(json_decode(setting('isite::emails'),true),'value');
                   @endphp
                   @if(count($addresses)>0)<b>{{ trans('iquote::quotes.pdf.address') }} : </b>{{ join($addresses,' - ') }} - @endif @if(count($phones)>0) <b>{{ trans('iquote::quotes.pdf.phone_mini') }} : </b>{{ join($phones,' - ') }} - @endif @if(count($emails)>0) <b>{{ trans('iquote::quotes.pdf.email') }} : </b>{{ join($emails,' - ') }} @endif

                </div>--}}
            </div>
        </header>
        <main>
            <div style="width:100%;font-size:14px;text-align:left;padding: 15px" class="page-break">
                {{--<div class="mj-column-per-100">
                    {!! setting('iquote::pdf-header-text') !!}
                </div>--}}
                <div class="mj-column-per-100"><h1 class="text-primary" style="text-align: center">{{ trans('iquote::iquotes.title.resume') }}</h1></div>
                <div class="mj-column-per-100 head-title">{{ trans('iquote::iquotes.title.consultant_profile') }}</div>
                <div class="mj-column-per-100" style="padding: 10px">
                    <div class="mj-column-per-66">
                        <p>
                        <div class="text-primary"><strong><i class="fas fa-user"></i>{{ trans('iquote::quotes.pdf.first_name') }}</strong></div>
                        <div>{{ $quote->user->fullName ?? '--' }}</div>
                        </p>
                    </div>
                    <div class="mj-column-per-33">
                        <p>
                        <div class="text-primary"><strong><i class="fas fa-mobile-alt"></i>{{ trans('iquote::quotes.pdf.phone') }}</strong></div>
                        <div>{{ $quote->user->phone ?? '--' }}</div>
                        </p>
                    </div>
                </div>
                <div class="mj-column-per-100 head-title border-top-radius">{{ trans('iquote::iquotes.title.customer_profile') }}</div>
                <div style="border: 1px solid #E5E5E5;border-top: none;padding: 10px" class="border-bottom-radius">
                    <div class="mj-column-per-33">
                        <p>
                            <div class="text-primary"><strong><i class="fas fa-user"></i>{{ trans('iquote::quotes.pdf.first_name') }}</strong></div>
                            <div>{{ $quote->firstName }}</div>
                        </p>
                        <p>
                            <div class="text-primary"><strong><i class="fas fa-mobile-alt"></i>{{ trans('iquote::quotes.pdf.phone') }}</strong></div>
                            <div>{{ $quote->phone ?? '--' }}</div>
                        </p>
                        {{--<p>
                            <div class="text-primary"><strong><i class="fas fa-id-card-alt"></i>{{ trans('iquote::quotes.pdf.document_id') }}</strong></div>
                            <div>{{ $quote->options->identification ?? '--' }}</div>
                        </p>
                        <p>
                            <div class="text-primary"><strong><i class="fas fa-thumbtack"></i>{{ trans('iquote::quotes.pdf.city') }}</strong></div>
                            <div>{{ $quote->options->city->label  ?? '--' }}</div>
                        </p>--}}
                    </div>
                    <div class="mj-column-per-33">
                        <p>
                            <div class="text-primary"><strong><i class="far fa-user"></i>{{ trans('iquote::quotes.pdf.last_name') }}</strong></div>
                            <div>{{ $quote->lastName }}</div>
                        </p>
                        <p>
                            <div class="text-primary"><strong><i class="fas fa-envelope"></i>{{ trans('iquote::quotes.pdf.email') }}</strong></div>
                            <div>{{ $quote->email ?? '--' }}</div>
                        </p>
                        {{--<p>
                            <div class="text-primary"><strong><i class="fas fa-map-marker-alt"></i>{{ trans('iquote::quotes.pdf.state') }}</strong></div>
                            <div>{{ $quote->options->department->label  ?? '--' }}</div>
                        <p>--}}
                    </div>
                    <div class="mj-column-per-33">
                        <p>
                        <div class="text-primary"><strong><i class="fas fa-globe-americas"></i>{{ trans('iquote::quotes.pdf.country') }}</strong></div>
                        <div>{{ $quote->options->country->label ?? '--' }}</div>
                        </p>
                        <p>
                        <div class="text-primary"><strong><i class="fas fa-calendar-day"></i>{{ trans('iquote::quotes.pdf.birthday') }}</strong></div>
                        <div>{{ $quote->options->birthday ?? '--' }}</div>
                        </p>
                        {{--<div class="text-primary"><strong><i class="fas fa-comment-dots"></i>{{ trans('iquote::quotes.pdf.notes') }}</strong></div>
                        <div>{!! $quote->notes ?? '--' !!}</div>--}}
                    </div>
                </div>
                <div>&nbsp;</div>
                <div class="mj-column-per-100 head-title" style="text-align: center">{{ trans('iquote::iquotes.title.quote_profile') }}</div>
            </div>
            <div style="padding: 0 15px;min-height: 400px;width: 100%;font-size: 14px">
                {!! $quote->treePdf !!}
                <div style="padding-bottom: 15px">
                    <p><span class="text-primary text-bold">{{ trans('iquote::quotes.pdf.notes') }}</span></p>
                    <p>{!! $quote->notes ?? '--' !!}</p>
                </div>
                <table width="100%" valign="top" class="t3">
                    <tbody>
                        <tr class="t1">
                            <td class="head-title" width="45%">{{ trans('iquote::iquotes.title.total') }}</td>
                            <td width="55%" align="right" class="text-primary"><b>{{ number_format($quote->total) }} {{ \Currency::getLocaleCurrency()->code }}</b></td>
                        </tr>
                    </tbody>
                </table>
                <div style="padding-bottom: 15px">
                    <p>{!! setting('iquote::pdf-footer-text') ?? '' !!}</p>
                </div>
            </div>
        </main>
    </body>
</html>
