@component('mail::message')
    # Beste {{ $data->firstname }} {{ $data->lastname }},

    U heeft zich aangemeld voor {{$data->title}} op {{ date_format(new Datetime($data->sign_up_at),'D j F G:i Y') }}.
    <br>
    Deze sessie begint op {{ date_format(new Datetime($data->begin_date),'D j F G:i Y') }}.
    <br>
    Bedankt,<br>
    Het {{ config('app.name') }} Team
@endcomponent
