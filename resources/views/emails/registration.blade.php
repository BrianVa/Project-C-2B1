@component('mail::message')
# Beste {{ $data["firstname"] }} {{ $data["lastname"] }}.

U heeft zich geregistreed bij {{ config('app.name') }}  Klik op de onderstaande knop om uw account te activeren.
@component('mail::button', ['url' => url('/verify?code=').$data["ver_code"]])
Activeer
@endcomponent

Werkt de knop niet? klik dan hier: <a href="{{url('/verify?code=')}}{{$data["ver_code"]}}">activeer</a><br>
<br>
of kopieer deze regel in je browser en druk op enter: {{url('/verify?code=')}}{{$data["ver_code"]}}

Bedankt,<br>
{{ config('app.name') }} Team
@endcomponent
