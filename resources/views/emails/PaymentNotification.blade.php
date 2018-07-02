@component('mail::message')
<div align="center">
     <img src="{{asset('frontend/assets/images/portal_images/email-logo.png')}}" align="center">
</div>
# Hi {{$data['profile']['first_name']}},

You are about to make a payment of <b>&#x20a6;{{number_format(($data['amount'] / 100),2)}}</b> for a booking on our platform. Find your payment reference below
@component('mail::panel')
<div align="center">
     {{ $data['reference']}}
</div>
@endcomponent
This email confirms that you are the one making the payment.

Sincerely,<br>
{{ config('app.name') }}
@endcomponent
