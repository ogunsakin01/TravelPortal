@component('mail::message')
<div align="center">
        <img src="{{asset('frontend/assets/images/portal_images/email-logo.png')}}" align="center">
</div>
# Hi {{$profile['first_name']}}

Your reservation has been marked has paid. Your ticket will be processed within the next 24hrs, an issue ticket confirmation email will be sent to you, an E-ticket will also be sent to your email.

Payment Reference     :   <b>{{$response['reference']}}</b> <br/>
Booking Reference     :   <b>{{$booking->reference}}</b><br/>
Customer Name         :   <b>{{$profile['first_name'],' ',$profile['middle_name'],' ',$profile['last_name']}}</b><br/>
Amount Paid           :   <b>&#x20a6;{{number_format(($response['amount']/100),2)}} </b>

Follow the link below to manage your bookings and payments ...

@component('mail::button', ['url' => url('/bookings/flight/itinerary-booking-information/'.$booking->reference)])
    View Reservation
@endcomponent

Sincerely,<br>
{{ config('app.name') }}
@endcomponent
