@component('mail::message')
<div align="center">
        <img src="{{asset('frontend/assets/images/portal_images/email-logo.png')}}" align="center">
    </div>
# Hello {{$user['profile']['first_name']}} ,

We are sad to inform you that your reservation with reference code below has been cancelled on our system,

@component('mail::panel')
    <div align="center">
        <b>{{ $booking['reference']}}</b>
    </div>
@endcomponent

Follow the button below to manage your bookings,
@component('mail::button', ['url' => '/dashboard'])
Dashboard
@endcomponent

Sincerely,<br>
{{ config('app.name') }}
@endcomponent
