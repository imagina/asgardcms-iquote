<!doctype html>
<html lang="{{ locale() }}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta charset="utf-8" />
    <title>{{ setting('core::site-name') }} - {{ trans('iquote::iquotes.title.iquotes') }} #{{ str_pad($quote->id,5,'0',STR_PAD_LEFT) }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/brands.min.css" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/regular.min.css" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/solid.min.css" type="text/css" />
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Muli">
    <style type="text/css">
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

        .border-top-radius{
            border-top-left-radius: 7px;
            border-top-right-radius: 7px;
        }

        .border-bottom-radius{
            border-bottom-left-radius: 7px;
            border-bottom-right-radius: 7px;
        }

        * {
            @if(config()->has('asgard.iquote.config.fontName'))
                font-family: '{{ config()->get('asgard.iquote.config.fontName') }}', sans-serif;
            @else
                font-family: Helvetica, sans-serif;
            @endif
            box-sizing: border-box;
        }

        table.t3{
            border-collapse: separate;
            border-spacing: 0;
            overflow: hidden;
            border-radius: 7px;
            border: 1px solid #E5E5E5;
        }

        .mj-column-per-66 {
            width:60%!important;
            display: inline-block!important;
            vertical-align: top;
        }
        .mj-column-per-33 {
            width: 30% !important;
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
            float: left;
            vertical-align: top;
            top: 0;
            position: absolute;
        }
        .head-title{
            background-color: {{ setting('isite::brandPrimary') }};
            color: #fff;
            padding: 8px;
            font-size: 18px;
            z-index: 1;
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
            margin: 60px 25px;
        }
        header {
            /** Extra personal styles **/
            text-align: center;
            line-height: 35px;
        }
        .footer {
            height: 50px;
            font-size: 14px;
            /** Extra personal styles **/
            line-height: 35px;
        }
        table, table tr, table tr td{
            page-break-inside: always;
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
        tr.t1 td{
            border-top: 1px solid #E5E5E5;
            border-bottom: 1px solid #E5E5E5;
            border-right: 1px solid #E5E5E5;
            padding: 10px 5px;
        }
        tr.t1 td:last-child{
            border-right: none;
        }
        .table-bg{
            background-color: #f0f2f4;
            padding: 10px 5px;
        }
        .page-break{ page-break-inside:auto;}
        #watermark {
            position: absolute;
            /**
                Set a position in the page for your image
                This should center it vertically
            **/
            top: 25px;
            left: 0;
            /** Change image dimensions**/
            width:    60mm;
            height:   35mm;
            /** Your watermark should be behind every content**/
            opacity: 0.6;
            z-index: 1000;
            padding-left: 15px;
        }
    </style>

</head>
<body>
<header>
    <div style="width:100%;cursor:auto;color:#000000;font-family:Ubuntu, sans-serif;line-height:1.5;text-align:right;">
        <p><strong><span style="font-size:10px;">{{ setting('core::site-name') }} - {{ trans('iquote::iquotes.title.iquotes') }} #{{ str_pad($quote->id,5,'0',STR_PAD_LEFT) }}</span></strong></p>
    </div>
    <div id="watermark">
        <img src="{{ setting('isite::logo1') }}" height="auto" width="100%" />
    </div>
</header>
<main>
    @php
      $mailContent = ['nombre' => $quote->firstName.' '.$quote->lastName];
      $search = [];
      $replace = [];
      foreach($mailContent as $index=>$value){
          $search[] = '{'.$index.'}';
          $replace[] = $value;
      }
    @endphp
    <div class="page-break" style="width:100%;font-size:14px;text-align:left;padding: 15px">
        <div id="contend-mail" class="p-3">
            <div class="text-primary head-text">
                <strong>
                    <span style="font-size:10px;">{{ setting('core::site-name') }} - {{ trans('iquote::iquotes.title.iquotes') }} #{{ str_pad($quote->id,5,'0',STR_PAD_LEFT) }}</span>
                </strong>
            </div>
            <div style="margin-bottom: 5px" class="text-primary">
                A quote has been sent for download.
            </div>
            <div style="margin-bottom: 5px">
                <p class="text-primary"><button class="btn btn-danger"><a href="{{ route('iquote.pdf',['quote'=>$quote->id]) }}" target="_blank">{{ trans('iquote::quotes.buttons.view_quote') }}</a></button></p>
            </div>
            <p class="text-primary"><b>{{ trans('iquote::quotes.messages.copy_quote_link') }}</b> {{ route('iquote.pdf',['quote'=>$quote->id]) }}</p>
        </div>
    </div>
    <p>&nbsp;</p>
    <div style="width:100%;text-align: center">
        <div>
            @php
                $addresses = array_column(json_decode(setting('isite::addresses'),true),'value');
                $phones = array_column(json_decode(setting('isite::phones'),true),'value');
                $emails = array_column(json_decode(setting('isite::emails'),true),'value');
            @endphp
            @if(count($addresses)>0)<b>{{ trans('iquote::quotes.pdf.address') }} : </b>{{ join($addresses,' - ') }} - @endif @if(count($phones)>0) <b>{{ trans('iquote::quotes.pdf.phone_mini') }} : </b>{{ join($phones,' - ') }} - @endif @if(count($emails)>0) <b>{{ trans('iquote::quotes.pdf.email') }} : </b>{{ join($emails,' - ') }} @endif
        </div>
    </div>
</main>
    <script type="text/javascript">
      var lNode = document.createElement("link");
      lNode.setAttribute("rel", "stylesheet");
      lNode.setAttribute("href", "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css");
      document.getElementsByTagName("head")[0].appendChild(lNode)
    </script>
</body>
</html>
