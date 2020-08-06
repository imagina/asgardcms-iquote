{{ setting('core::site-name') }} - {{ trans('iquote::iquotes.title.iquotes') }} #{{ str_pad($quote->id,5,'0',STR_PAD_LEFT) }}
A quote has been sent for download.
Copy this link in navigator bar: {{ route('iquote.pdf',['quote'=>$quote->id]) }}

