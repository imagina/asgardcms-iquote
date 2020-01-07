@extends(View::exists('email.plantilla')?'email.plantilla':'iquote::frontend.emails.mainlayout')

@section('content')
  <!--[if mso | IE]>
  <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%" align="center" style="width:100%;">
    <tr>
      <td style="line-height:0px;font-size:0px;mso-line-height-rule:exactly;">
  <![endif]-->
  <div style="margin:0px auto;max-width:100%;background: #244f67; top center / auto repeat;">
    <!--[if mso | IE]>
    <v:rect xmlns:v="urn:schemas-microsoft-com:vml" fill="true" stroke="false" style="width:600px;">
      <v:fill origin="0.5, 0" position="0.5,0" type="tile" src="https://storage.googleapis.com/afuxova10642/pozadimz.png" />
      <v:textbox style="mso-fit-shape-to-text:true" inset="0,0,0,0">
    <![endif]-->
    <table role="presentation" cellpadding="0" cellspacing="0" style="font-size:0px;width:100%;background:{{ setting('isite::brandSecondary') }} top center / auto repeat;" align="center" border="0">
      <tbody>
      <tr>
        <td style="text-align:center;vertical-align:top;direction:ltr;font-size:0px;padding:11px 0px 11px 0px;">
          <!--[if mso | IE]>
          <table role="presentation" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td style="vertical-align:top;width:100%;">
          <![endif]-->
          <div class="mj-column-per-100 outlook-group-fix" style="vertical-align:top;display:inline-block;direction:ltr;font-size:13px;text-align:left;width:100%;">
            <table role="presentation" cellpadding="0" cellspacing="0" style="vertical-align:top;" width="100%" border="0">
              <tbody>
              <tr>
                <td style="word-wrap:break-word;font-size:0px;padding:7px 7px 7px 7px;" align="center">
                  <div style="cursor:auto;color:{{ setting('isite::brandSecondary') }};font-family:Ubuntu, Helvetica, Arial, sans-serif;font-size:11px;line-height:1.5;text-align:center;">
                    <p><span style="color:#ffffff;"><span style="font-size:16px;"><strong>#{{ str_pad($quote->id,5,'0',STR_PAD_LEFT) }} - {{ $quote->firstName }} {{ $quote->lastName }}</strong></span></span></p>
                    <p><span style="font-size:12px;"><span style="color:#ffffff;">{{ $quote->notes }}</span></span></p>
                  </div>
                </td>
              </tr>
              </tbody>
            </table>
          </div>
          <!--[if mso | IE]>
          </td>
          </tr>
          </table>
          <![endif]-->
        </td>
      </tr>
      </tbody>
    </table>
    <!--[if mso | IE]>
    <p style="margin:0;mso-hide:all">
      <o:p xmlns:o="urn:schemas-microsoft-com:office:office"> </o:p>
    </p>
    </v:textbox>
    </v:rect>
    <![endif]-->
  </div>
  <!--[if mso | IE]>
  </td>
  </tr>
  </table>
  <![endif]-->
  <!--[if mso | IE]>
  <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="600" align="center" style="width: 100%;">
    <tr>
      <td style="line-height:0px;font-size:0px;mso-line-height-rule:exactly;">
  <![endif]-->
  <div style="margin:0px auto;background:#FEFEFF; padding: 0 20px">
    <table role="presentation" cellpadding="0" cellspacing="0" style="font-size:0px;width:100%;background:#FEFEFF;" align="center" border="0">
      <tbody>
      <tr>
        <td style="text-align:center;vertical-align:top;direction:ltr;padding:11px 0px 11px 0px;">
          <div class="outlook-group-fix" style="vertical-align:top;display:block;direction:ltr;font-size:13px;text-align:center;width:100%;">
            <h2>Características</h2>
          </div>
            <!--[if mso | IE]>
            <table role="presentation" border="0" cellpadding="0" cellspacing="5">
              <tr>
                <td style="vertical-align:top;width:100%;">
            <![endif]-->
            {!! $quote->tree !!}
            <!--[if mso | IE]>
                </td>
              </tr>
            </table>
            <![endif]-->
        </td>
      </tr>
      </tbody>
    </table>
  </div>
  <!--[if mso | IE]>
  </td>
  </tr>
  </table>
  <![endif]-->
  {{--<div id="contend-mail" class="p-3">
    <h1>Cotización de {{ $quote->firstName }} {{ $quote->lastName }}</h1>
    <br>
    <div style="margin-bottom: 5px">
      <p class="px-3">{{ $quote->notes }} </p>
      <h3></h3>
      @foreach($quote->value as $value)
        @php
          $val = json_decode(json_encode($value))
        @endphp
        <p class="px-3"><strong>{{ $val->name }}</strong></p>
        <p class="px-3">{!! $val->description !!}</p>
        <p class="px-3"><strong>Características:</strong></p>
        @foreach($val->characteristics as $character)
          <p class="px-3"><strong>{{ $character->name }}:</strong> {{ $character->model->label ?? 'N/A'  }}</p>
        @endforeach
      @endforeach
    </div>
  </div>--}}
@stop
