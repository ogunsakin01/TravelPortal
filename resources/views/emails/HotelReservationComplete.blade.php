@component('mail::message')
<div align="center">
    <img src="{{asset('frontend/assets/images/portal_images/email-logo.png')}}" align="center">
</div>
# Hi {{$user['first_name']}}

Your booking was successful. Find below the details of the hotel and room you just booked, if the check in and check out time is not attached to their dates, please call the hotel contact number attached to this email or call the portal customer care number.


<b>Booking Ref</b>      :  {{ $bookingInfo['reference']}}<br/>
<b>Reservation Code</b> :  {{ $bookingInfo['pnr']}}<br/>
<b>Hotel Name</b>       :  {{$hotelInfo['hotelName']}}<br/>
<b>Room Info</b>        :  {{$roomInfo['roomDescription']}}<br/>
<b>Check In</b>         :  {{date('d, D M. Y',strtotime($hotelInfo['startDate']))}}<br/>
<b>Check Out</b>        :  {{date('d, D M. Y',strtotime($hotelInfo['endDate']))}}<br/>
<b>Phone No</b>         :  {{$hotelInfo['hotelContactNumber']}}<br/>
<b>Address</b>          :  {{$hotelInfo['hotelAddress']}}


Find below the hotel reservation code
@component('mail::panel')
<div align="center">
    <b>{{ $bookingInfo['pnr']}}</b>
</div>
@endcomponent

Follow the button below to your dashboard to manage your bookings
@component('mail::button', ['url' => url('/bookings/hotel/hotel-reservation-information/'.$bookingInfo['reference'])])
    View Reservation
@endcomponent

Sincerely,<br>
{{ config('app.name') }}
@endcomponent

