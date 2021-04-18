@component('mail::message')
# Beste {{ $data["firstname"] }} {{ $data["lastname"] }},

U heeft zich geregistreerd bij {{ config('app.name') }}. <br>  Klik op de onderstaande knop om uw account te activeren.
@component('mail::button', ['url' => url('/verify?code=').$data["ver_code"]])
Activeer
@endcomponent

Werkt de knop niet? klik dan hier: <a href="{{url('/verify?code=')}}{{$data["ver_code"]}}">activeer</a><br>

of kopieer deze regel in je browser en druk op enter: {{url('/verify?code=')}}{{$data["ver_code"]}}

Bedankt,
{{ config('app.name') }} Team.
@endcomponent
