@component('mail::message')
# Webinar {{ $webinar->name }} zaraz się zacznie

Otrzymjesz tego maila ponieważ zapisałaś/zapisałeś się na ten webinar.
Kliknij w poniższy link aby wziąć w nim udział:

@component('mail::button', ['url' => route('webinar.login', [$webinar, $token])])
Weź udział w webinarze
@endcomponent

Do zobaczenia,
{{ config('app.name') }}
@endcomponent