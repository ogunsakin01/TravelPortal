@component('mail::message')
<div align="center">
    <img src="{{asset('frontend/assets/images/portal_images/email-logo.png')}}" align="center">
</div>
# Hello {{$user['profile']['first_name']}},

Your ticket with ticket number <b>{{$ticketNumber}}</b> has been voided successfully.

Kindly follow the link below to manage your booking.
@component('mail::button', ['url' => '/dashboard'])
    Dashboard
@endcomponent

Sincerely,<br>
{{ config('app.name') }}
@endcomponent
