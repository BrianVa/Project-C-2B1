@component('mail::message')
# Hallo {{ $data["firstname"] }} {{ $data["lastname"] }}.

Welcome bij cimsolutions u ontvangt deze email omdat u zich heeft geregistreed bij cimsolutions klik op de onderstaande knop om uw account te activeren!

@component('mail::button', ['url' => url('/verify?code=').$data["ver_code"]])
Activeer
@endcomponent


mocht de boven staande knop niet werken klik dan op deze link: <a href="{{url('/verify?code=')}}{{$data["ver_code"]}}">activeer</a>

Bedankt,<br>
{{ config('app.name') }} Team
@endcomponent
