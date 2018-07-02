@component('mail::message')
<div align="center">
   <img src="{{asset('frontend/assets/images/portal_images/email-logo.png')}}" align="center">
</div>
# Payment Successful

You payment has been successfully processed, further email regarding your booking will be sent to you

Payment Reference     :   <b>{{$response['reference']}}</b><br/>
Amount Paid           :   <b>&#x20a6;{{number_format(($response['amount']/100),2)}} </b>

Follow the link below to manage your bookings and payments ...
@component('mail::button', ['url' => '/dashboard'])
Dashboard
@endcomponent

Sincerely,<br>
{{ config('app.name') }}
@endcomponent
