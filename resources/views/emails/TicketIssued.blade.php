@component('mail::message')
<div align="center">
    <img src="{{asset('frontend/assets/images/portal_images/email-logo.png')}}" align="center">
</div>
# Hello {{$user['profile']['first_name']}},

We are happy to inform you that we have issued the ticket(s) for your booking with booking reference below, an email containing your ticket will be send to you shortly.

@component('mail::panel')
<div align="center">
      <b>{{ $booking['reference']}}</b>
</div>
@endcomponent

Follow the button below to manage your bookings,
@component('mail::button', ['url' => '/dashboard'])
    Dashboard
@endcomponent

Sinerely,<br>
{{ config('app.name') }}
@endcomponent
