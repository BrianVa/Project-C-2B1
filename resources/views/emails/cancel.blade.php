@component('mail::message')
    # Beste {{ $data->firstname }} {{ $data->lastname }},

    U heeft zich afgemeld voor {{$data->title}} op {{ date_format(new Datetime(),'D j F G:i Y') }}.
    <br>
    Bedankt,<br>
    Het {{ config('app.name') }} Team.
@endcomponent
