@component('mail::message')
<div align="center">
        <img src="{{asset('frontend/assets/images/portal_images/email-logo.png')}}" align="center">
</div>
# Hi {{$user->profile->first_name}},
Your reservation was successful, kindly find your reservation information below

<b>Deal Name</b>                      :  {{ $deal->name}}<br/>
<b>Flight</b>                         :  @if($deal->flight == 1) Available @else Not Available @endif <br/>
<b>Hotel</b>                          :  @if($deal->hotel == 1) Available @else Not Available @endif<br/>
<b>Attraction</b>                     :  @if($deal->attraction == 1) Available @else Not Available @endif<br/>
<b>Adult({{$booking->adults}})</b>    :  &#x20a6;{{number_format(($booking->adults * $deal->adult_price),2)}}<br/>
<b>Child({{$booking->children}})</b>  :  &#x20a6;{{number_format(($booking->children * $deal->child_price),2)}}<br/>
<b>Infant({{$booking->infants}})</b>  :  &#x20a6;{{number_format(($booking->infants * $deal->infant_price),2)}}<br/>
<b>Total Booking Amount</b>           :  &#x20a6;{{number_format(($booking->total_amount/100),2)}}


Find below the booking reference
@component('mail::panel')
<div align="center">
  {{ $booking->reference}}
</div>
@endcomponent

Follow the button below to your dashboard to manage your bookings
@component('mail::button', ['url' => url('/dashboard')])
Dashboard
@endcomponent

Sincerely,<br>
{{ config('app.name') }}
@endcomponent
