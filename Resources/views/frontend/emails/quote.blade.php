<!doctype html>
<html lang="{{ locale() }}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta charset="utf-8" />
    <title>{{ setting('core::site-name') }} - Cotización #{{ str_pad($quote->id,5,'0',STR_PAD_LEFT) }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/brands.min.css" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/regular.min.css" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/solid.min.css" type="text/css" />
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
        * {
            font-family: Verdana, Arial, sans-serif;
            box-sizing: border-box;
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
            position: fixed;
            top: -70px;
            left: 0px;
            right: 0px;
            height: 50px;
            /** Extra personal styles **/
            text-align: center;
            line-height: 35px;
        }
        .footer {
            position: fixed;
            bottom: -60px;
            left: 0px;
            right: 0px;
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
            border-top: 1px solid #888;
            border-bottom: 1px solid #888;
            border-right: 1px solid #888;
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
        <p><strong><span style="font-size:10px;">{{ setting('core::site-name') }} - Cotización #{{ str_pad($quote->id,5,'0',STR_PAD_LEFT) }}</span></strong></p>
    </div>
    <div id="watermark">
        <img src="{{ setting('isite::logo1') }}" height="auto" width="100%" />
    </div>
</header>
<main>
    <div class="page-break" style="width:100%;font-size:14px;text-align:left;padding: 15px">
        <div class="mj-column-per-100"><h1 class="text-primary" style="text-align: center">Resumen de la Cotización</h1></div>
        <div class="mj-column-per-100 head-title">Perfil del Cliente</div>
        <div style="border: 1px solid #888; padding: 10px">
            <div class="mj-column-per-33">
                <p>
                <div class="text-primary"><strong><i class="fas fa-user"></i>Nombres: </strong></div>
                <div>{{ $quote->firstName }}</div>
                </p>
                <p>
                <div class="text-primary"><strong><i class="fas fa-id-card-alt"></i>Cédula o Nit: </strong></div>
                <div>{{ $quote->phone ?? '--' }}</div>
                </p>
                <p>
                <div class="text-primary"><strong><i class="fas fa-globe-americas"></i>País: </strong></div>
                <div>{{ $quote->customer->addresses[0]->country ?? '--' }}</div>
                </p>
                <p>
                <div class="text-primary"><strong><i class="fas fa-thumbtack"></i>Ciudad: </strong></div>
                <div>{{ $quote->customer->addresses[0]->city ?? '--' }}</div>
                </p>
                <p>
                <div class="text-primary"><strong><i class="fas fa-envelope"></i>Correo: </strong></div>
                <div>{{ $quote->email ?? '--' }}</div>
                </p>
            </div>
            <div class="mj-column-per-33">
                <p>
                <div class="text-primary"><strong><i class="far fa-user"></i>Apellidos: </strong></div>
                <div>{{ $quote->lastName }}</div>
                </p>
                <p>
                <div class="text-primary"><strong><i class="fas fa-calendar-day"></i>Fecha de Nacimiento: </strong></div>
                <div>{{ $quote->phone ?? '--' }}</div>
                </p>
                <p>
                <div class="text-primary"><strong><i class="fas fa-map-marker-alt"></i>Departamento o Estado: </strong></div>
                <div>{{ $quote->customer->addresses[0]->state ?? '--' }}</div>
                </p>
                <p>
                <div class="text-primary"><strong><i class="fas fa-arrow-circle-right"></i>Dirección: </strong></div>
                <div>{{ $quote->customer->addresses[0]->address1 ?? '--' }}</div>
                </p>
                <p>
                <div class="text-primary"><strong><i class="fas fa-mobile-alt"></i>Celular o Teléfono: </strong></div>
                <div>{{ $quote->phone ?? '--' }}</div>
                </p>
            </div>
            <div class="mj-column-per-33">
                <div class="text-primary"><strong><i class="fas fa-comment-dots"></i>Notas Adicionales: </strong></div>
                <div>{!! $quote->notes ?? '--' !!}</div>
            </div>
        </div>
        <div>&nbsp;</div>
        <div class="mj-column-per-100 head-title">Perfil de la Cotización</div>
    </div>
    <div style="padding: 0 20px;min-height: 400px;width: 100%;font-size: 14px">
        {!! $quote->treePdf !!}
        <p>&nbsp;</p>
        <table width="100%" valign="top">
            <tfoot>
            <tr class="t1">
                <td class="head-title" width="45%">Gran Total</td>
                <td width="55%" align="right" class="text-primary"><b>{{ number_format($quote->total) }} {{ setting('iquote::currency-symbol') }}</b></td>
            </tr>
            </tfoot>
        </table>
    </div>
    <div style="width:100%;text-align: center">
        <div>
            Copyrights © {{ date('Y') }} All Rights Reserved by <a href='{{ url('/') }}' target="_blank">{{ setting('core::site-name') }}</a>.
        </div>
    </div>
</main>
</body>
</html>
