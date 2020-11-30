@component('mail::message')
# Hallo {{ $data->firstname }} {{ $data->lastname }}.

Welcom bij cimsolutions u ontvangt deze email omdat u zich heeft geregistreed bij cimsolutions klik op de onderstaande knop om uw account te activeren!

@component('mail::button', ['url' => ''])
Activeer
@endcomponent

Bedankt,<br>
{{ config('app.name') }} Team
@endcomponent
